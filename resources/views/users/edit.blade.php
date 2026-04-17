@extends('layouts.master')
@section('style')
        <style>
            body {
                text-align: center;
            }
            h1 {
                margin-top: 30px;
                margin-bottom: 30px;
            }
            form {
                border: 2px solid black;
                border-radius: 25px;
                margin: 0 auto;
                padding: 30px;
                width: 400px;
                text-align: start;
            }
            .form-group {
                padding-bottom: 10px;
            }
        </style>
@endsection
@section('content')
        <h1>Edit Book : {{ $book->title }}</h1>
        <form action="{{ route('update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Title : </label>
                <input type="text" name="title" value="{{ $book->title }}">
            </div>
            <div class="form-group">
                <label>Category : </label>
                <input type="text" name="category" value="{{ $book->category }}">
            </div>
            <div class="form-group">
                <label>Status : </label>
                <select name="status">
                    <option value="available" {{ $book->status == 'available' ? 'selected' : ''}}>Available</option>
                    <option value="borrowed" {{ $book->status == 'borrowed' ? 'selected' : ''}}>Borrowed</option>
                </select>
            </div>
            <button type="submit">Update Book</button>
        </form>
@endsection