@extends('layouts.master')
@section('style')
<style>
    body {
        text-align: center;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        margin: 0 auto;
        padding: 10px;
    }
</style>
@endsection
@section('content')
<h1>User List</h1>
<table id="myTable">
    <thead>
        <tr>
            <th>Username</th><th>Email</th><th>Application_Date</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <form action="{{ route('user.edit', $user->id) }}" method="GET" class="d-inline">
                        <button class="btn btn-sm btn-success">Edit User</button>
                    </form>
                    <form action="{{ route('user.delete', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete User</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@section('script')
    <script>
        $(document).ready(function() {
            // เรียกใช้งาน DataTables ผ่าน ID ของตาราง
            $('#myTable').DataTable();
        });
    </script>
@endsection
@endsection