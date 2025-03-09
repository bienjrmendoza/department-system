<nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm">
    <div class="container d-flex justify-content-end">
        <div class="d-flex">
            <div class="dropdown">
                <button class="btn btn-white border-0" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-4"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>