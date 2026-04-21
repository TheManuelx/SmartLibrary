<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;

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
            'category_id' => 'required',
            'status' => 'required',
            'cover_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imageName = time(). '.' .$request->cover_image->extension();
        $request->cover_image->move(public_path('image'), $imageName);

        Book::create([
            'title' => $request->title,
            'published_year' => $request->published_year,
            'category_id' => $request->category_id,
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
        return view('books.detail', compact('book'));
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
        $allCategories = Category::all();
        return view('users.edit', compact('book', 'allCategories'));
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
            'category_id' => 'required',
            'status' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2024',
        ]);

        $book = Book::findOrFail($id);

        $updateData = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ];

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image && file_exists(public_path('image/' . $book->cover_image))) {
                unlink(public_path('image/' . $book->cover_image));
            }

            $imageName = time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('image'), $imageName);
            
            // เพิ่มชื่อรูปใหม่เข้าไปในข้อมูลที่จะอัปเดต
            $updateData['cover_image'] = $imageName;
        }

        // 3. อัปเดตข้อมูลทั้งหมด
        $book->update($updateData);
        
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
        if ($request->filled('category') && $request->category != 'All') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category());
            });
        }

        $book = $query->get();
        return view('books.searchbook', compact('book'));
    }
    public function searchCategory(Request $request)
    {
        $categoryName = $request->category ?? 'All';
        $query = Book::query();
        if ($categoryName != 'All') {
            $query->whereHas('category', function($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }
        $book = $query->get();
        $count = $book->count();
        return view('books.searchcategory', compact('book', 'categoryName', 'count'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255',
        ]);
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('Success', 'Add Category Successfully');
    }

    //Borrowing Table
    //Read
    public function manageBorrowings(Request $request) {
        $query = Borrowing::with(['user', 'book']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('book', function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }
        $borrowings = $query->get();
        return view('borrowings.borroweditems', compact('borrowings'));
    }

    //Update
    public function returnBook($id) {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update(['status' => 'returned']);

        $borrowing->book->update(['status' => 'available']);

        return redirect()->back()->with('Success', 'Return The Book Successfully');
    }

    //Create
    public function createBorrowing() {
        $users = User::all();
        $books = Book::where('status', 'available')->get();
        return view('borrowings.create', compact('users', 'books'));
    }

    //Store
    public function storeBorrowing(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        //Borrow History
        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->start_date,
            'return_date' => $request->end_date,
            'status' => 'borrowed',
        ]);

        //Change Status to Borrowed
        Book::where('id', $request->book_id)->update(['status' => 'borrowed']);

        return redirect()->route('borroweditems')->with('Success', 'Borrowed Successfully');
    }

    public function destroyBorrowing($id) {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status == 'borrowed'){
            $borrowing->book->update(['status' => 'available']);
        }

        $borrowing->delete();
        return redirect()->back()->with('Success', 'Borrowing Record Deleted');
    }

    // >--- USER ---<
    public function viewUser() {
        $users = User::all();
        return view('users.profile', compact('users'));
    }
    //Edit User
    public function editUser($id) {
        $user = User::findOrFail($id);
        return view('users.edituser', compact('user'));
    }
    //Update User
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'created_at' => 'required',
        ]);

        $user = User::findOrFail($id);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // 3. อัปเดตข้อมูลทั้งหมด
        $user->update($updateData);
        
        return redirect()->route('users')->with('Success', 'User Updated Successfully');
    }
    //Delete User
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users')->with('Success', 'Delete a User Successfully');
    }
}
