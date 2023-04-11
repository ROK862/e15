<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Book;

class BookController extends Controller
{
    /**
    * GET /books/create
    * Display the form to add a new book
    */
    public function create(Request $request)
    {
        return view('books/create');
    }

    /**
    * POST /books
    * Process the form for adding a new book
    */
    public function store(Request $request)
    {
        # Validate the request data
        # The `$request->validate` method takes an array of data
        # where the keys are form inputs
        # and the values are validation rules to apply to those inputs
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:books,slug',
            'author' => 'required|max:255',
            'published_year' => 'required|digits:4',
            'cover_url' => 'required|url',
            'info_url' => 'required|url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:100'
        ]);

        # Note: If validation fails, it will automatically redirect the visitor back to the form page
        # and none of the code that follows will execute.
        
        $book = new Book();
        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();

        return redirect('/books/create')->with(['flash-alert' => 'Your book was added.']);
    }

    /**
    * GET /search
    * Show search results
    */
    public function search(Request $request)
    {
        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required'
        ]);

        # If validation fails it will redirect back to `/`

        $bookData = file_get_contents(database_path('books.json'));
        $books = json_decode($bookData, true);

        $searchType = $request->input('searchType', 'title');
        $searchTerms = $request->input('searchTerms', '');
        $searchResults = [];
    
        foreach ($books as $slug => $book) {
            if (strtolower($book[$searchType]) == strtolower($searchTerms)) {
                $searchResults[$slug] = $book;
            }
        }

        # Redirect back to the form with data/results stored in the session
        # Ref: https://laravel.com/docs/responses#redirecting-with-flashed-session-data
        return redirect('/')->with([
            'searchResults' => $searchResults
        ])->withInput();
    }

    /**
     * GET /books
     * Show all the books
     */
    public function index()
    {
        $books = Book::orderBy('title', 'ASC')->get();

        //$newBooks = Book::orderBy('id', 'DESC')->limit(3)->get();
        
        $newBooks = $books->sortByDesc('id')->take(3);

        return view('books/index', [
            'books' => $books,
            'newBooks' => $newBooks
        ]);
    }

    /**
     * GET /books/{slug}
     * Show an individual book searching by slug
     */
    public function show($slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        return view('books/show', [
            'book' => $book,
        ]);
    }

    /**
    * GET /books/{slug}/edit
    */
    public function edit(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        if (!$book) {
            return redirect('/books')->with(['flash-alert' => 'Book not found.']);
        }

        return view('books/edit', [
            'book' => $book,
        ]);
    }

    /**
    * PUT /books
    */
    public function update(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:books,slug,' . $book->id . '|alpha_dash',
            'author_id' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'url',
            'info_url' => 'url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:255'
        ]);

        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();

        return redirect('/books/'.$slug.'/edit')->with(['flash-alert' => 'Your changes were saved.']);
    }

    /**
     * GET /books/filter/{category}/{subcategory}
     * Filter method that was demonstrate working with multiple route parameters
     */
    public function filter($category, $subcategory)
    {
        return 'Show all books in these categories: ' . $category . ',' . $subcategory;
    }
}
