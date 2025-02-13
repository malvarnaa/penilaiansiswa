<x-layout>
    @section('title', 'Data Master - GradeFlow')
    <div class="container-fluid mt-4">
        <h2 class="mb-4">Data Master</h2>
        <div class="row justify-content-center">
            <div class="col-12 mb-2">
                <div class="card shadow-lg border-0 rounded-lg d-flex flex-row align-items-center" style="background: linear-gradient(135deg, #007BFF, #0056b3); color: white; padding: 20px;">
                    <div class="me-3">
                        <i class="fas fa-briefcase fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Program Keahlian</h5>
                        <p class="card-text">Data mengenai berbagai program keahlian yang tersedia.</p>
                    </div>
                    <a href="/konsentrasi-keahlian" class="btn btn-light rounded-pill">Lihat Data</a>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="card shadow-lg border-0 rounded-lg d-flex flex-row align-items-center" style="background: linear-gradient(135deg, #28A745, #196F3D); color: white; padding: 20px;">
                    <div class="me-3">
                        <i class="fas fa-book fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Mata Pelajaran</h5>
                        <p class="card-text">Informasi lengkap mengenai mata pelajaran yang diajarkan.</p>
                    </div>
                    <a href="/mata-pelajaran" class="btn btn-light rounded-pill">Lihat Data</a>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="card shadow-lg border-0 rounded-lg d-flex flex-row align-items-center" style="background: linear-gradient(135deg, #FFC107, #FFA000); color: white; padding: 20px;">
                    <div class="me-3">
                        <i class="fas fa-chalkboard-teacher fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Kelas</h5>
                        <p class="card-text">Detail tentang kelas yang tersedia di sekolah.</p>
                    </div>
                    <a href="/data/kelas" class="btn btn-light rounded-pill">Lihat Data</a>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="card shadow-lg border-0 rounded-lg d-flex flex-row align-items-center" style="background: linear-gradient(135deg, #DC3545, #A71D2A); color: white; padding: 20px;">
                    <div class="me-3">
                        <i class="fas fa-user-tie fa-3x"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="card-title">Guru</h5>
                        <p class="card-text">Daftar guru beserta mata pelajaran yang mereka ajarkan.</p>
                    </div>
                    <a href="/data/guru" class="btn btn-light rounded-pill">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>