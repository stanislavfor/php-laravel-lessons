<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        return view('books.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_year' => 'required|integer',
            'publisher' => 'required|string|max:255',
            'pages' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $validatedData['cover'] = $path;
        }

        Book::create($validatedData);

        return redirect()->back()->with('success', 'Книга успешно добавлена.');
    }

    public function show()
    {
        $books = Book::all();
        return view('books.show', compact('books'));
    }

    public function info()
    {
        return view('books.info');
    }



}
