@extends('layouts.master')
@section('style')
        <style>
            .table-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 20px;
            }
            body {
                text-align: center;
            }
            table {
                border-collapse: collapse;
                width: 90%;
                max-width: 1000px;
            }
            th, td {
                border: 1px solid #dee2e6;
                padding: 12px;
                text-align: center;
            }
            th {
                background-color: #f8f9fa;
            }
        </style>
@endsection
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('content')
        <div class="table-container">
            <h1>Manage Books</h1>
            <table>
                <tr><th>Cover_Image</th><th>Title</th><th>Published_Year</th><th>Category</th><th>Status</th><th>Details</th><th>Edit</th><th>Delete</th></tr>
                @foreach($books as $book)
                    <tr>
                        <td><img src="{{ asset('image/' . $book->cover_image) }}" width="50"></td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->published_year }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->status }}</td>
                        <td><a href="{{ route('detail', $book->id) }}">Detail</a></td>
                        <td><a href="{{ route('edit', $book->id) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('delete', $book->id) }}" method="POST" onsubmit="return confirm('Confirming to Delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

@endsection
