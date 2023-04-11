<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class PracticeController extends Controller
{

    public function practice8()
    {
        $books = Book::all();
        echo $books;
    }

    public function practice7()
    {
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump('Book not found!');
        } else {
            $book->delete();
            dump('Book deleted!');
        }

        dump(Book::where('author', '=', 'F. Scott Fitzgerald')->get()->toArray());
    }

    public function practice6()
    {
        # First get books to update
        $books = Book::where('author', '=', 'J.K. Rowling')->get();

        if (!$books) {
            dump("Book not found, can not update.");
        } else {
            foreach ($books as $book) {
                # Change some properties
                $book->author = 'JK Rowling';
            
                # Save the changes
                $book->save();
            }

            dump('Update complete');
        }

        # Output books to confirm the above query worked as expected
        dump(Book::all()->toArray());
    }

    public function practice5()
    {
        # First get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump("Book not found, can not update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published_year = '2025';

            # Save the changes
            $book->save();

            dump('Update complete');
        }

        # Output books to confirm the above query worked as expected
        dump(Book::orderBy('published_year')->get()->toArray());
    }

    public function practice4()
    {
        $book = new Book();
        $books = $book
            ->where('title', 'LIKE', '%Harry Potter%')
            ->orWhere('published_year', '>', 1998)
            ->select('title')
            ->get();

        # Output books to confirm the above query worked as expected
        dump($books->toArray());
    }

    public function practice3()
    {
        # Create a new instance of our Book model
        $book = new Book();

        # Set the properties for a new row
        # Note how each property corresponds to a field in the table
        $book->slug = 'the-martian';
        $book->title = 'The Martian';
        $book->author = 'Anthony Weir';
        $book->published_year = 2011;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/the-martian.jpg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Martian_(Weir_novel)';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-martian-andy-weir/1114993828';
        $book->description = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';

        # Persist the book to the database
        $book->save();
        
        # Confirm results
        dump('The book ' . $book->title . ' was added');
        dump(Book::all()->toArray());
    }

    public function practice2()
    {
        dump(config('app.timezone'));
    }


    public function practice1()
    {
        dump('This is the first example.');
    }

    public function index(Request $request, $n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method($request) : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with([
                'methods' => $methods,
                'books' => Book::all(),
                'fields' => [
                    'id', 'updated_at', 'created_at', 'slug', 'title', 'author', 'published_year'
                ]
            ]);
        }
    }
}
