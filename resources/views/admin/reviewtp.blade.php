<x-layout>
    @section('title', 'Review Tujuan Pembelajaran - GradeFlow')
    <h2 class="mt-4 mb-4">{{ $judul }}</h2>

    <div class="card shadow-sm p-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama File</th>
                    <th>Di-upload Oleh</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($uploads as $upload)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $upload->file_name }}</td>
                    <td>{{ $upload->user ? $upload->user->name : 'Unknown' }}</td>
                    <td>{{ $upload->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $upload->file_path) }}" class="btn btn-sm btn-info" target="_blank">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ asset('storage/' . $upload->file_path) }}" class="btn btn-sm btn-success downloadtp" download>
                            <i class="bi bi-download"></i>
                        </a>
                        <form action="{{ route('review.destroy', $upload->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger deletetp" type="submit">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script>
        document.querySelectorAll('.deletetp').forEach(link => {
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

        document.querySelectorAll('.downloadtp').forEach(link => {
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
    </script>
    

</x-layout>