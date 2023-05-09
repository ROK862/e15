<!--Handle New Items-->
@if($partial == false)

<div class="general-input-wrapper">
    <input name="name" id="name" type="text" placeholder="Item Name" value="{{ old('name') }}" />
    @if ($errors->has('name'))
    <div class="message-warning">{{ $errors->first('name') }}</div>
    @endif
</div>
<div class="general-input-wrapper">
    <input name="price" id="price" type="number" step="0.01" placeholder="Item Price" value="{{ old('price') }}" />
    @if ($errors->has('price'))
    <div class="message-warning">{{ $errors->first('price') }}</div>
    @endif
</div>
<div class="general-input-wrapper">
    <input name="maximum_shipping_duration" id="maximum_shipping_duration" type="number"
        placeholder="Shipping Duration in Days." value="{{ old('maximum_shipping_duration') }}" />
    @if ($errors->has('maximum_shipping_duration'))
    <div class="message-warning">{{ $errors->first('maximum_shipping_duration') }}</div>
    @endif
</div>
<div class="general-input-wrapper">
    <input name="image" id="image" type="file" placeholder="Item Image" />
    @if ($errors->has('image'))
    <div class="message-warning">{{ $errors->first('image') }}</div>
    @endif
</div>
<div class="general-input-wrapper">
    <textarea name="description" id="item-description">{{ old('description', '') }}</textarea>
    @if ($errors->has('description'))
    <div class="message-warning">{{ $errors->first('description') }}</div>
    @endif
</div>
<button>Save</button>
<!--Edited Items-->
@else

<div class="general-input-wrapper">
    <input name="name" id="name" value="{{ old('name', $item['name']) }}" type="text" placeholder="Item Name" />
    @if ($errors->has('name'))
    <div class="message-warning">{{ $errors->first('name') }}</div>
    @endif
</div>
<div class="general-input-wrapper">
    <input name="price" id="price" value="{{ old('price', $item['price']) }}" type="number" step="0.01"
        placeholder="Item Price" />
    @if ($errors->has('price'))
    <div class="message-warning">{{ $errors->first('price') }}</div>
    @endif
</div>
<div class="general-input-wrapper">
    <input name="maximum_shipping_duration" id="maximum_shipping_duration"
        value="{{ old('maximum_shipping_duration', $item['maximum_shipping_duration']) }}" type="number"
        placeholder="Shipping Duration in Days." />
    @if ($errors->has('maximum_shipping_duration'))
    <div class="message-warning">{{ $errors->first('maximum_shipping_duration') }}</div>
    @endif
</div>
<div class="general-input-wrapper">
    <textarea name="description" id="description">{{ old('description', $item['description']) }}</textarea>
    @if ($errors->has('description'))
    <div class="message-warning">{{ $errors->first('description') }}</div>
    @endif
</div>
<button>Save</button>
@endif