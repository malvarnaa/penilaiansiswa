<x-layout>
    @section('title', 'Download Blanko Dokumen - GradeFlow')

    <div class="container">
        <h2 class="mb-3 mt-2">Downlaod Blanko Dokumen</h2>

        <!-- Section Download Blanko -->
        <div class="text-center mb-3">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <h4 class="mb-3" style="font-size: 1rem;">Download Blanko Dokumen</h4>
                    <p class="text-muted mb-4" style="font-size: 0.75rem;">Klik tombol di bawah untuk melihat daftar file tujuan pembelajaran yang telah disiapkan oleh admin.</p>
                    <a href="{{ route('admin.listUnduh') }}" class="btn btn-lg text-white w-100" style="background-color: #435ebe; font-size: 0.75rem;">
                        Lebih Detail <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm p-4" style="width: 100%">
            <h5 class="mb-3">Upload Tujuan Pembelajaran</h5>
            <form action="{{ route('guru.uploadtp') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Pilih File PDF:</label>
                    <input type="file" name="file" id="file" class="form-control" accept="application/pdf" required>
                </div>
                <button type="submit" class="btn w-100 text-white" style="background-color: #435ebe">Upload</button>
            </form>
        </div>

        <div class="card shadow-sm p-4">
            <h5 class="mb-3">Riwayat Upload Tujuan Pembelajaran</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama File</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploads as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->file_name }}</td>
                        <td>{{ $data->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $data->file_path) }}" class="btn btn-sm btn-info" target="_blank">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ asset('storage/' . $data->file_path) }}" class="btn btn-sm btn-success unduh" download>
                                <i class="bi bi-download"></i>
                            </a>
                            <form action="{{ route('review.destroy', $data->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger deleteTP" type="submit">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>

    <script>
        document.querySelectorAll('.unduh').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah aksi default link (yaitu membuka file)
                    Swal.fire({
                        title: 'Unduh',
                        text: "Apakah Anda yakin ingin mengunduh data ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Unduh!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = link.href; // Lanjutkan download setelah konfirmasi
                        }
                    });
                });
            });

            document.querySelectorAll('.deleteTP').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah aksi default link (yaitu membuka file)
                    Swal.fire({
                        title: 'Hapus',
                        text: "Apakah Anda yakin ingin menghapus data ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = link.href; // Lanjutkan download setelah konfirmasi
                        }
                    });
                });
            });
    </script>
</x-layout>
