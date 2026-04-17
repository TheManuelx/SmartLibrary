<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">SmartLibrary</a>

        <div>
            <a class="navbar-brand" href="{{ route('dashboard') }}">DashBoard</a>
        </div>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- 1. Search Box (Left) -->
            <form class="d-flex mx-auto" action="{{ route('searchbook') }}" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="ค้นหาหนังสือ..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ms-auto">
                <!-- 2. Dropdown Select Categories -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('searchcategory', ['category' => 'category']) }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown">Categories</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('searchcategory', ['category' => 'Technology']) }}">Technology</a></li>
                        <li><a class="dropdown-item" href="{{ route('searchcategory', ['category' => 'Education']) }}">Education</a></li>
                        <li><a class="dropdown-item" href="{{ route('searchcategory', ['category' => 'Novel']) }}">Novel</a></li>
                        <li><a class="dropdown-item" href="{{ route('searchcategory', ['category' => 'Science']) }}">Science</a></li>
                        <li><a class="dropdown-item" href="{{ route('searchcategory', ['category' => 'History']) }}">History</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('searchcategory', ['category' => 'All']) }}">All</a></li>
                    </ul>
                </li>

                <!-- 3. Add New Book Button (Right) -->
                <li class="nav-item">
                    <a class="btn btn-primary ms-2" href="{{ route('books.create') }}">+ Add Book</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
