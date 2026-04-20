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
        <form action="{{ route('update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Title : </label>
                <input type="text" name="title" value="{{ $book->title }}">
            </div>
            <div class="form-group">
                <label>Category : </label>
                <select name="category_id">
                    @foreach($allCategories as $cat)
                        <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Status : </label>
                <select name="status">
                    <option value="available" {{ $book->status == 'available' ? 'selected' : ''}}>Available</option>
                    <option value="borrowed" {{ $book->status == 'borrowed' ? 'selected' : ''}}>Borrowed</option>
                </select>
            </div>
            <div class="form-group">
                <label>Current Image : </label>
                <img src="{{ asset('image/' . $book->cover_image) }}" width="100" class="mb-2"><br>
                <label>Change Cover Image : </label>
                <input type="file" name="cover_image" accept="image/*">
                <small class="text-muted">Leave Blank to Keep Current Image</small>
            </div>
            <button type="submit">Update Book</button>
        </form>
@endsection