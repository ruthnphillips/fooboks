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

	public function show($title)
	{
		return 'You selected '.$title;
	}
}
