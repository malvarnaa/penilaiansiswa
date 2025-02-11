<x-layout>
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Program Keahlian</h2>
        <a href="{{ route('admin.dataMaster') }}" class="btn btn-secondary">Kembali</a>
    </div>  

    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary d-flex ms-auto" data-bs-toggle="modal" data-bs-target="#jurusanCreateModal">Tambah</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Konsentrasi</th>
                        <th>Konsentrasi Keahlian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jurusans as $index => $jurusan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jurusan->jurusan }}</td>
                        <td>{{ $jurusan->kode_jurusan }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('jurusan.edit', $jurusan->id) }}" class="btn btn-sm btn-warning"  data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $jurusan->id }}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <!-- Delete Button (using form for delete) -->
                            <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger deleteKonke" title="Hapus">
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

    @include('mapel.jurusanCreate')
    @include('mapel.jurusanEdit')

    <script>
            document.querySelectorAll('.deleteKonke').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah aksi default submit form

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
                            this.closest('form').submit(); // Menjalankan submit form
                        }
                    });
                });
            });

    </script>

</x-layout>
