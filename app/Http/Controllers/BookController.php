<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    //
	public function index()
	{
		return 'This is the book list';
	}

	/**
	* GET
	* /books/{title?}
	*/
	public function show($title)
    {
        return view('book.show')->with([
            'title' => $title
        ]);
    }

}
