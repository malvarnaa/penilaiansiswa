<x-layout>
    @section('title','Data Kelas - GradeFlow')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Data Kelas</h2>
        <a href="{{ route('admin.dataMaster') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('kelas.all') }}" class="btn btn-secondary">Lihat Semua Kelas</a>
    </div>  

    <div class="d-flex flex-wrap justify-content-center">
        <a href="{{ route('kelas.show', ['kelas' => 'X']) }}" class="card m-2 rounded-3 bg-info text-dark" style="flex: 1 1 calc(33.333% - 1rem); text-decoration: none; color: black; transform: scale(1); transition: transform 0.3s;">
            <div class="card-body text-center p-5">
                <i class="bi bi-person-square fs-1 mb-3"></i> <!-- Ikon Bootstrap Icons -->
                <h5 class="fw-bold">Kelas 10</h5>
                <p class="text-muted">Kelola kelas untuk tingkat 10.</p>
            </div>
        </a>
        <a href="{{ route('kelas.show', ['kelas' => 'XI']) }}" class="card m-2 rounded-3 bg-success text-dark" style="flex: 1 1 calc(33.333% - 1rem); text-decoration: none; color: black; transform: scale(1); transition: transform 0.3s;">
            <div class="card-body text-center p-5">
                <i class="bi bi-person-square fs-1 mb-3"></i> <!-- Ikon Bootstrap Icons -->
                <h5 class="fw-bold">Kelas 11</h5>
                <p class="text-muted">Kelola kelas untuk tingkat 11.</p>
            </div>
        </a>
        <a href="{{ route('kelas.show', ['kelas' => 'XII']) }}" class="card m-2 rounded-3 bg-warning text-dark" style="flex: 1 1 calc(33.333% - 1rem); text-decoration: none; color: black; transform: scale(1); transition: transform 0.3s;">
            <div class="card-body text-center p-5">
                <i class="bi bi-person-square fs-1 mb-3"></i> <!-- Ikon Bootstrap Icons -->
                <h5 class="fw-bold">Kelas 12</h5>
                <p class="text-muted">Kelola kelas untuk tingkat 12.</p>
            </div>
        </a>
    </div>
</x-layout>
