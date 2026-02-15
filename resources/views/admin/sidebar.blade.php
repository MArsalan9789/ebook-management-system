
<div class="sidebar" id="sidebar">
     <div class="logo mb-4 text-center">
        <img src="{{ asset('assets/frontend/images/main-logo.png') }}" alt="E-Book Admin Logo" class="img-fluid" style="max-width:100px;">
    </div>

    <a class="nav-link" href="{{ route('admindashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>

    <div class="nav-item mb-2">
        <a class="nav-link" data-bs-toggle="collapse" href="#booksSubmenu">
            <i class="fa fa-book me-2"></i> Books
            <i class="fa fa-caret-down float-end"></i>
        </a>
        <div class="collapse" id="booksSubmenu">
            <ul class="nav flex-column ms-3">
                <li class="nav-item"><a class="nav-link" href="{{ route('createbook') }}">Add Book</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('booklist') }}">List Books</a></li>
            </ul>
        </div>
    </div>

    <a class="nav-link" href="{{ route('alluser') }}"><i class="fa fa-users me-2"></i> Users</a>
    <a class="nav-link" href="{{route('orderlist')}}"><i class="fa fa-cart-shopping me-2"></i> Orders</a>
    <a class="nav-link" href="{{ route('competitionlist') }}"><i class="fa fa-trophy me-2"></i> Competitions</a>



    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button class="btn btn-danger w-100">Logout</button>
    </form>
</div>

