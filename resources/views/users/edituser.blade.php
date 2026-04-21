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
        <h1>Edit User : {{ $user->name }}</h1>
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Username : </label>
                <input type="text" name="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label>Email : </label>
                <input type="email" name="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label>Application Date : </label>
                <input type="date" name="created_at" value="{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}">
            </div>
            <div class="form-group">
                <button type="submit">Update User</button>
            </div>
            
        </form>
@endsection