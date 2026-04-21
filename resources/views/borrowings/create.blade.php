@extends('layouts.master')
@section('style')
<style>
    .form-group {
        margin-bottom:  10px;
    }
    button {
        margin-top: 10px;
    }
</style>

@endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Create New Borrowing</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('borrowing.manage') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Username : </label>
                            <select name="user_id" class="form-control" required>
                                <option value="">>--Select User--<</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title : </label>
                            <select name="book_id" class="form-control" required>
                                <option value="">>--Select Title--<</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Start Date : </label>
                            <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label>End Date : </label>
                            <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection