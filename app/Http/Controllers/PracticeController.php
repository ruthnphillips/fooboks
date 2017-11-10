<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class PracticeController extends Controller
{
    // practice21
    public function practice21()
	{

	}

    // practice20
    public function practice20()
	{

	}

    // practice19
    public function practice19()
	{

	}

    // practice18
    public function practice18()
	{
        #
	}
    // practice17
    public function practice17()
	{
        #Remove any books by the author “J.K. Rowling”.
        $results = Book::where('author', '=', 'J.K. Rowling')->delete();
        dump($results);
	}

    // practice16
    public function practice16()
	{
        #Find any books by the author Bell Hooks and update the author name to be bell hooks (lowercase).
        $results = Book::where('author', '=', 'Bell Hooks')->get();
        if ($results->isEmpty())
        {
            dump('Book not found');
        }
        else
        {
            foreach ($results as $key => $value)
            {
                $value->author = strtolower($value->author);
                # Save the changes
                $value->save();
            }
            dump('hello');
        }
	}

    // practice15
    public function practice15()
	{
        #Retrieve all the books in descending order according to published date.
        $results = Book::orderBy('published', 'desc')->get();
        dump($results->toArray());
	}

    // practice14
    public function practice14()
	{
        #Retrieve all the books in alphabetical order by title.
        $results = Book::orderBy('title')->get();
        dump($results->toArray());
	}

    // practice13
    public function practice13()
	{
        #Retrieve all the books published after 1950.
        $results = Book::where('published', '>', 1950)->get();
        dump($results->toArray());
	}

    // practice 12
    public function practice12()
	{
        #Retrieve the last 5 books that were added to the books table.
        $result = Book::orderBy('created_at', 'desc')->limit(2)->get();
        dump($result->toArray());
	}

    // practice 11
    public function practice11()
	{
        # Limit the amount of results a query will return
        $result = Book::where('published', '>', 1800)->limit(2)->get();
        dump($result->toArray());
	}

    // practice 10
    public function practice10()
	{
        # First get a book to delete
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
	}
        // practice 9
    public function practice9()
    {
        # First get a book to update
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        if (!$book) {
            dump("Book not found, can't update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }
    }

    // practice 8
    public function practice8()
	{
        # Get all the books
            # There is no constraint method
            # `all` is the fetch method
        $results = Book::all();
        dump($results->toArray()); # Study the results
	}

    // practice 7
    public function practice7()
	{
        # Get only books that were published after 1950 *and* authored by F. Scott Fitzgerald
            # `where` is the constraint method, and it's used twice
            # `get` is the fetch method
        $results = Book::where('published', '>', 1950)->where('author', '=', 'F. Scott Fitzgerald')->get();
        dump($results->toArray()); # Study the results
	}

    // practice 6

    public function practice6()
	{
        # Get the *first* book in the table that was authored by F. Scott Fitzgerald
            # `where` & `orderBy` are the constraint methods
            # `first` is the fetch method
        $results = Book::where('author', '=', 'F. Scott Fitzgerald')->orderBy('created_at')->first();
        dump($results->toArray()); # Study the results
	}

    // practice 5
    public function practice5()
    {
        # Get only books that were authored by F. Scott Fitzgerald
            # `where` is the constraint method
            # `get` is the fetch method
        $results = Book::where('author', '=', 'F. Scott Fitzgerald')->get();
        dump($results->toArray()); # Study the results
    }

    // practice 4
    public function practice4()
	{
        # Get only books published after 1950
        #   `where` is the constraint method
        #   `get` is the fetch method
        $results = Book::where('published', '>', 1950)->get();
        dump($results->toArray()); # Study the results
	}

    // practice 3
    public function practice3()
	{
        $countries = [
            'Canada',
            'Mexico',
            'USA'
        ];
        return view('test.show')->with([
            'countries' => $countries
        ]);
	}

	// practice 2
	public function practice2()
	{
		$email = config('mail');
		dump($email);
	}
    //practice 1
	public function practice1()
	{
		dump('This is practice 1');
	}

	/**
    * ANY (GET/POST/PUT/DELETE)
    * /practice/{n?}
    *
    * This method accepts all requests to /practice/ and
    * invokes the appropriate method.
    *
    * http://foobooks.loc/practice/1 => Invokes practice1
    * http://foobooks.loc/practice/5 => Invokes practice5
    * http://foobooks.loc/practice/999 => Practice route [practice999] not defined
    */
    public function index($n = null)
    {
        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    # Echo'ing display code from a controller is typically bad; making an
                    # exception here because:
                    # 1. This controller is for debugging/demonstration purposes only
                    # 2. This controller is introduced before we cover views
                    echo "<a href='".str_replace('practice', '/practice/', $method)."'>" . $method . "</a><br>";
                }
            }
        # Otherwise, load the requested method
        } else {
            $method = 'practice'.$n;

            if (method_exists($this, $method)) {
                return $this->$method();
            } else {
                dd("Practice route [{$n}] not defined");
            }
        }
    }
}
