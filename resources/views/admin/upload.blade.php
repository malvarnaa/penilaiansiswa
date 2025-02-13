<x-layout>
    @section('title', 'Upload Tujuan Pembelajaran - GradeFlow')
    <div class="container mt-3">
        <div class="row">
            <div class="">
                <h2 class="mb-4">Upload Tujuan Pembelajaran</h2>

                {{-- Form Upload PDF --}}
                <div class="card shadow-sm p-4" style="width: 100%">
                    <h5 class="mb-3">Upload PDF</h5>
                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File PDF:</label>
                            <input type="file" name="file" id="file" class="form-control" accept="application/pdf" required>
                        </div>
                        <button type="submit" class="btn w-100 text-white" style="background-color: #435ebe">Upload</button>
                    </form>
                </div>

                {{-- List File yang Sudah Di-upload --}}
                <div class="mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">File yang Sudah Di-upload</h5>
                            @if ($uploads->isEmpty())
                                <div class="alert alert-warning">Belum ada file yang di-upload.</div>
                            @else
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama File</th>
                                            <th>Di-upload Oleh</th>
                                            <th>Tanggal</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($uploads as $key => $upload)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $upload->file_name }}</td>
                                                <td>{{ $upload->user->name }}</td>
                                                <td>{{ $upload->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a href="{{ asset('storage/' . $upload->file_path) }}" class="btn btn-success btn-sm downloadForm" download>
                                                            <i class="bi bi-download"></i>
                                                        </a>                                                        
                                                        <form action="{{ route('admin.show', $upload->id) }}" target="_blank" class="mx-1">
                                                            <button class="btn btn-info detail-button btn-sm">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.delete', $upload->id) }}" method="POST" class="deleteForm" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" type="submit">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.deleteForm').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form disubmit langsung
                Swal.fire({
                    title: 'Hapus Data',
                    text: "Apakah Anda yakin ingin menghapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form jika user menekan tombol 'Ya, Hapus!'
                    }
                });
            });
        });

        document.querySelectorAll('.downloadForm').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah aksi default link (yaitu membuka file)
                Swal.fire({
                    title: 'Download Data',
                    text: "Apakah Anda yakin ingin mendownload data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Download!',
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
