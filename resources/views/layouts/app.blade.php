<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartLibrary</title>
    <!-- Bootstrap CSS -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <style>
        .navbar-custom { background-color: #f8f9fa; }
    </style>
</head>
<body>
    @include('layouts.navbar')
    
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://jsdelivr.net"></script>
</body>
</html>
