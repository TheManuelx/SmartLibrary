<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Total Number of the Books
        $totalBooks = Book::count();

        //Total Number of Borrowed Books
        $borrowedBooks = Book::where('status', 'borrowed')->count();

        $totalUsers = User::count();

        return view('users.dashboard', compact('totalBooks', 'borrowedBooks', 'totalUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'published_year' => 'required|numeric',
            'category' => 'required',
            'status' => 'required',
            'cover_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imageName = time(). '.' .$request->cover_image->extension();
        $request->cover_image->move(public_path('image'), $imageName);

        Book::create([
            'title' => $request->title,
            'published_year' => $request->published_year,
            'category' => $request->category,
            'status' => $request->status,
            'cover_image' => $imageName,
        ]);

        return redirect()->route('managebooks')->with('Success', 'A New Book Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('users.detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('users.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'status' => 'required',
        ]);
        $book = Book::findOrFail($id);
        $book->update([
            'title' => $request->title,
            'category' => $request->category,
            'status' => $request->status,
        ]);
        return redirect()->route('managebooks')->with('success', 'Book Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('managebooks')->with('Success', 'Delete a Book Successfully');
    }

    public function loginValidate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email or Password Invalid',
        ])->onlyInput('email');
    }
    
    public function manageBooks()
    {
        $books = Book::all();
        return view('users.managebooks', compact('books'));
    }

    public function searchBook(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->has('category') && $request->category != 'All'){
            $query->where('category', $request->category);
        }

        $book = $query->get();
        return view('books.searchbook', compact('book'));
    }
    public function searchCategory(Request $request)
    {
        $query = Book::query();
        if ($request->has('category') && $request->category != 'All') {
            $query->where('category', $request->category);
        }
        $book = $query->get();
        return view('books.searchcategory', compact('book'));
    }
}
