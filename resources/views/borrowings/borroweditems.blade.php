@extends('layouts.master')
@section('style')
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        display: flexbox;
        margin: 0 auto;
    }
    th, td {
        padding: 5px;
    }
    h1 {
        text-align: center;
        margin-top: 40px;
    }
</style>
@endsection
@section('content')
<h1>Borrowed Item</h1>
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('borrowing.create') }}" class="btn btn-primary">Add Borrowing</a>
        <form action="{{ route('borroweditems') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search Username / Book">
            <button type="submit" class="btn btn-outline-success">Search</button>
        </form>
    </div>
    <table>
        <tr><th>Borrower_Name</th><th>Title</th><th>Start_Date</th><th>End_Date</th><th>Status</th><th>Action</th></tr>
        @foreach($borrowings as $item)
            <tr>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->borrow_date }}</td>
                <td>{{ $item->return_date }}</td>
                <td>
                    <span class="badge {{ $item->status == 'borrowed' ? 'bg-warning' : 'bg-success' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>
                    @if($item->status == 'borrowed')
                        <form action="{{ route('return.book', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success">Return Book</button>
                        </form>
                    @endif
                    <form action="{{ route('borrowings.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection