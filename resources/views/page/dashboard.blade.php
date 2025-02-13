<x-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    @section('title', 'GradeFlow')

    <h2 class="mt-4 mb-4">{{ $welcome }} {{ Auth::user()->name }}!</h2>
    

    {{-- <div class="container mt-5">
        <div class="card col-md-6 shadow-sm mx-auto" style="height: 200px; margin: 20px auto; border-radius: 10px;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <h3 id="jam" class="card-title" style="font-size: 1.5rem; margin: 0;">00:00:00</h3>
                <h4 id="tanggal" class="mt-2" style="color: #435ebe; font-size: 1rem;">Hari, Tanggal</h4>
            </div>
        </div>                       --}}
        
        {{-- @if (auth()->check() && auth()->user()->role === 'admin') --}}
        <div class="row">

            <div class="col-lg-4 col-md-6 mb-2">
                <div class="card shadow-sm text-white" style="background-color: #435ebe;">
                    <div class="card-body">
                        <i class="bi bi-box icon-size"></i>
                        <h5 class="card-title">Jumlah Guru</h5>
                        <div class="card-count">{{ $totalGuru }}</div>
                    </div>
                </div>
            </div>

            <!-- Total Penjualan -->
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="card bg-success shadow-sm text-white">
                    <div class="card-body">
                        <i class="bi bi-cash-stack icon-size"></i>
                        <h5 class="card-title">Jumlah Kelas</h5>
                        <div class="card-count">{{ $totalKelas }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-2">
                <div class="card bg-warning shadow-sm text-dark">
                    <div class="card-body">
                        <i class="bi bi-person-lines-fill icon-size"></i>
                        <h5 class="card-title">Jumlah Mata Pelajaran</h5>
                        <div class="card-count">{{ $totalMapel }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Informasi {{ Auth::user()->role }}</h4>
                <table class="table table-striped">
                    <tr>
                        <td style="padding-right: 10px;">Nama</td>
                        <td> : </td>
                        <td>{{ Auth::user()->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 10px;">Sebagai</td>
                        <td> : </td>
                        <td>{{ Auth::user()->role ?? '-' }}</td>
                    </tr>
                    @if(auth()->user()->role == 'guru') 
                    <tr>
                        <td style="padding-right: 10px;">Mengajar di Kelas</td>
                        <td> : </td>
                        <td>
                            @if($pengguna && $pengguna->kelas && $pengguna->kelas->isNotEmpty())
                                {{ $pengguna->kelas->pluck('kelas')->join(', ') }}
                            @else
                                Tidak ada kelas yang diajar
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-right: 10px;">Mengajar Mata Pelajaran</td>
                        <td> : </td>
                        <td>
                            @if($pengguna && $pengguna->mapel && $pengguna->mapel->isNotEmpty())
                                {{ $pengguna->mapel->pluck('mapel')->join(', ') }}
                            @else
                                Tidak ada mata pelajaran yang diajar
                            @endif
                        </td>
                    </tr>                       
                    @endif               
                </table>                
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <h5>File Terbaru yang Di-upload</h5>
        </div>
    
        <div class="card shadow-sm ">
            <div class="card-body text-center">
                @if ($latestUpload)
                    <h5 class="card-title mb-3"><strong>{{ $latestUpload->file_name }}</strong></h5>
                    <p class="text-muted mb-4">{{ $latestUpload->user->name }} - {{ $latestUpload->created_at->format('d M Y') }}</p>
        
                    <div class="d-flex justify-content-center mb-4">
                        <!-- Preview Icon for PDF -->
                        @if (in_array(pathinfo($latestUpload->file_name, PATHINFO_EXTENSION), ['pdf']))
                            <a href="{{ asset('storage/' . $latestUpload->file_path) }}" target="_blank" class="me-4">
                                <i class="bi bi-file-earmark-pdf" style="font-size: 60px; color: #f44336;"></i>
                            </a>
                        @else
                            <i class="bi bi-file-earmark" style="font-size: 60px; color: #2196F3;"></i>
                        @endif
                    </div>
        
                    <div class="d-flex justify-content-center gap-3">
                        <!-- Tombol untuk mengunduh (hanya ikon) -->
                        <a href="{{ asset('storage/' . $latestUpload->file_path) }}" class="btn btn-primary btn-sm shadow-sm" download="{{ $latestUpload->file_name }}">
                            <i class="bi bi-download" style="font-size: 18px;"></i> <span class="d-none d-sm-inline">Unduh</span>
                        </a>
                        
                        <!-- Tombol untuk melihat semua file (hanya ikon) -->
                        <a href="{{ route('admin.listUnduh') }}" class="btn btn-secondary btn-sm shadow-sm">
                            <i class="bi bi-folder" style="font-size: 18px;"></i> <span class="d-none d-sm-inline">Lihat Semua</span>
                        </a>
                    </div>
                    
                @else
                    <p class="text-muted">Tidak ada file yang di-upload.</p>
                @endif
            </div>
        </div>
                
        
                        
                

        {{-- @endif --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Nilai Rata-rata</h5>
                        <canvas id="chartNilaiRataRata" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Rekap Nilai Siswa</h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Nilai Rata-rata</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>XII IPA 1</td>
                                    <td>85</td>
                                    <td><a href="#" class="btn btn-primary btn-sm">Detail</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>XII IPA 2</td>
                                    <td>90</td>
                                    <td><a href="#" class="btn btn-primary btn-sm">Detail</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Michael Johnson</td>
                                    <td>XII IPA 3</td>
                                    <td>88</td>
                                    <td><a href="#" class="btn btn-primary btn-sm">Detail</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        {{-- {{ $transaksis->links('pagination::bootstrap-5') }} --}}

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateJam() {
            const now = new Date();
            const options = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            const formatter = new Intl.DateTimeFormat('id-ID', options);
            document.getElementById('jam').textContent = formatter.format(now);
        }
    
        setInterval(updateJam, 1000); // Perbarui setiap detik
        updateJam(); // Panggil saat pertama kali
    </script>

    <script>
        function updateDateTime() {
            const jamElement = document.getElementById("jam");
            const tanggalElement = document.getElementById("tanggal");

            // Ambil waktu saat ini
            const now = new Date();

            // Format waktu ke HH:mm:ss
            const waktu = now.toLocaleTimeString('id-ID', { hour12: false });

            // Nama hari dalam bahasa Indonesia
            const hari = now.toLocaleDateString('id-ID', { weekday: 'long' });

            // Format tanggal ke "DD Bulan YYYY"
            const tanggal = now.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            // Update elemen HTML
            jamElement.textContent = waktu;
            tanggalElement.textContent = `${hari}, ${tanggal}`;
        }

        // Jalankan fungsi setiap detik
        setInterval(updateDateTime, 1000);

        // Jalankan sekali saat halaman dimuat
        updateDateTime();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data Grafik Dummy
        const data = {
            labels: ['Semester 1', 'Semester 2', 'Semester 3'],
            datasets: [{
                label: 'Nilai Rata-rata',
                data: [75, 80, 78], // Contoh data
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Konfigurasi Grafik
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Grafik Nilai Rata-rata Tiap Semester'
                    }
                }
            }
        };

        // Render Grafik
        const chartNilaiRataRata = new Chart(
            document.getElementById('chartNilaiRataRata'),
            config
        );
    </script>

</x-layout>
