<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        // validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'maximum_shipping_duration' => 'required|integer|min:1|max:31',
            'image' => 'required|image',
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field must be no more than 255 characters.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price field must be a numeric value.',
            'price.min' => 'The price field must be greater than 0.',
            'maximum_shipping_duration.required' => 'The maximum shipping duration field is required.',
            'maximum_shipping_duration.integer' => 'The maximum shipping duration field must be an integer value.',
            'maximum_shipping_duration.min' => 'The maximum shipping duration field must be greater than 0.',
            'maximum_shipping_duration.max' => 'The maximum shipping duration field must be less than or equal to 31.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The image must be a file of type image.',
        ]);

        // get the authenticated user instance
        $user = Auth::user();

        // Lets convert the image to a base64 so we can store it as a blob in the database.
        $image = $request->file('image');
        $imageData = base64_encode(file_get_contents($image));
        $imageExtension = $image->getClientOriginalExtension();
        $base64Image = 'data:image/' . $imageExtension . ';base64,' . $imageData;

        // create a new item with the user id and form data
        $item = new Item;
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->maximum_shipping_duration = $request->input("maximum_shipping_duration");
        $item->image = $base64Image;
        $item->user_id = $user->id;
        $item->save();

        // redirect to the manage items page
        return redirect()->route('manage');
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|gt:0',
            'maximum_shipping_duration' => 'required|integer|gt:0|lte:31',
        ], [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price field must be a number.',
            'price.gt' => 'The price field must be greater than 0.',
            'maximum_shipping_duration.required' => 'The maximum shipping duration field is required.',
            'maximum_shipping_duration.integer' => 'The maximum shipping duration field must be an integer.',
            'maximum_shipping_duration.gt' => 'The maximum shipping duration field must be greater than 0.',
            'maximum_shipping_duration.lte' => 'The maximum shipping duration field must be less than or equal to 31.',
        ]);

        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->save();

        return redirect()->route('manage');
    }

    public function updateVisibility(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        // Validate the request data
        $request->validate([
            'visibility' => 'required|in:visible,hidden'
        ], [
            'visibility.required' => 'Please specify the new visibility status.',
            'visibility.in' => 'Visibility can only be changed to visible or hidden.'
        ]);

        $newVisibility = $request->input('visibility');

        if ($item->visibility == $newVisibility) {
            return redirect()->back()->with('error', 'The visibility status of this item is already '.$newVisibility.'!');
        }

        $item->visibility = $newVisibility;
        $item->save();

        return redirect()->back()->with('success', 'Visibility status updated successfully!');
    }
}