@extends('layouts/main')

@section('title')
Edit book {{ $book->title }}
@endsection

@section('content')

<h1>Edit</h1>
<h2>{{ $book->title }}</h2>

<form method='POST' action='/books/{{ $book->slug }}'>
    <div class='details'>* Required fields</div>
    {{ csrf_field() }}
    {{ method_field('put') }}

    <label for='slug'>* Short URL</label>
    <input type='text' name='slug' id='slug' value='{{ old('slug', $book->slug) }}'>
    <div class='details'>
        This is is a unique URL identifier for the book, containing only alphanumeric characters and dashes.
        <br>It’s suggested that the slug be based on the book title, e.g. a good slug for the book <em>“War and Peace”</em> would be <em>“war-and-peace”</em>.
    </div>
   
    <label for='title'>* Title</label>
    <input type='text' name='title' id='title' value='{{ old('title', $book->title) }}'>

    <label for='title'>* Author</label>
    <input type='text' name='author' id='author' value='{{ old('author', $book->author) }}'>
   
    <label for='published_year'>* Published Year (YYYY)</label>
    <input type='text' name='published_year' id='published_year' value='{{ old('published_year', $book->published_year) }}'>

    <label for='cover_url'>Cover URL</label>
    <input type='text' name='cover_url' id='cover_url' value='{{ old('cover_url', $book->cover_url) }}'>

    <label for='info_url'>* Wikipedia URL</label>
    <input type='text' name='info_url' id='info_url' value='{{ old('info_url', $book->info_url) }}'>
       
    <label for='purchase_url'>* Purchase URL </label>
    <input type='text' name='purchase_url' id='purchase_url' value='{{ old('purchase_url', $book->purchase_url) }}'>
    
    <label for='description'>Description</label>
    <textarea name='description'>{{ old('description', $book->description) }}</textarea>
    
    <button type='submit' class='btn btn-primary'>Update Book</button>

    @if(count($errors) > 0)
        <div class='alert alert-danger'>
            Please correct the above errors.
        </div>
    @endif

</form>


@endsection
