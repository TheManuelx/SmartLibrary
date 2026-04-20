@extends('layouts.master')
@section('style')
        <style>
            body {
                text-align: center;
            }
            h1 {
                margin-top: 30px;
                margin-bottom: 10px;
            }
            .group {
                border: 5px solid blue;
                border-radius: 25px;
                margin: 0 auto;
                padding: 30px;
                width: 350px;
            }
            .container, img {
                
                margin: 0 auto;
                border: 2px solid blue;
                border-radius: 25px;
                width: 250px;
            }
            .container {
                text-align: start;
            }
        </style>
@endsection
@section('content')
        <h1>Detail</h1>
        <div class="group">
            <div><img src=" {{ asset('image/' . $book->cover_image) }}" width="100px"></div>
            <div class="container">Title : {{ $book->title }}</div>
            <div class="container">Year : {{ $book->published_year }}</div>
            <div class="container">Category : {{ $book->category->name }}</div>
            <div class="container">Status : {{ $book->status }}</div>
        </div>
@endsection
