<x-layout>
    @section('title', 'Data Siswa - GradeFlow')

    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Data Kelas {{ $kelasData->kelas }} {{ $kelasData->kode_jurusan }} {{ $kelasData->no_jrs }}</h2>
        <div>
            <a href="{{ route('kelas.show', $kelasData->kelas) }}" class="btn btn-secondary ms-2">Kembali</a>
        </div>
    </div>    

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah
                  </button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($siswaData->isEmpty())
                            <tr>
                                <td colspan="4" style="align-items: center; text-align: center;">Tidak ada data yang harus ditampilkan.</td>
                            </tr>
                        @else
                        @foreach ($siswaData ?? [] as $index => $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->jk }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $siswa->id }}">
                                        <i class="bi bi-pen"></i> 
                                    </button>
                                    <form action="{{ route('student.destroy', $siswa->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger deleteStudent"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @include('student.create')
    @include('student.edit')

    <script>
        document.querySelectorAll('.deleteStudent').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah submit langsung

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
                        this.closest('form').submit(); // Kirim form penghapusan
                    }
                });
            });
        });


    </script>
</x-layout>