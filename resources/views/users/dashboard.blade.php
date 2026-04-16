<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                height: 100%;
                margin: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            h1 {
                padding-top: 30px;
            }
            .dashboard-box {
                text-align: start;
                border: 1px solid black;
                border-radius: 25px;
                padding: 30px;
            }
            .sidebar {
                height: 100vh;
                width: 200px;
                position: fixed;
                top: 0;
                left: 0;
                background-color: #333;
                padding-left: 15px;
                padding-top: 15px;
            }
            .sidebar a {
                padding: 10px;
                display: block;
                color: white;
            }
        </style>
    </head>
    <body>
        <div><h1>DashBoard</h1></div>
        <nav class="sidebar">
            <img src="{{ asset('image/SmartLibrary.jpg') }}" width="180px">
            <a href="{{ route('managebooks') }}">Manage Books</a>
            <a href="{{ route('managecategories') }}">Manage Categories</a>
            <a href="{{ route('borroweditems') }}">Borrowed Items</a>
        </nav>
        <div class="dashboard-box">
            <p>
                <div>Total Number of the Books : {{ $totalBooks }}</div>
                <div>Total Number of Books Borrowed : {{ $borrowedBooks }}</div>
                <div>Number of Users : {{ $totalUsers }}</div>
            </p>
        </div>
    </body>
</html>