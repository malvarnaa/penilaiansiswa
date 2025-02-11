<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-shadow">
    <div class="container-fluid">
        <!-- Tombol Toggle Sidebar -->
        <button id="toggleSidebar" class="btn btn-toggle-sidebar">
            <i class="bi bi-list"></i> <!-- Ikon menu tanpa latar warna -->
        </button>
        <!-- Form Pencarian -->
        <form class="d-flex ms-auto me-3">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>
        <!-- Menu Dropdown User -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="user-avatar.jpg" alt="User" class="rounded-circle" width="30">
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>