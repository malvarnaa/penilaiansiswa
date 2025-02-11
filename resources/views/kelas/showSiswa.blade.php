<x-layout>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($siswaData->isEmpty())
                            <div class="alert alert-warning">Belum ada siswa di kelas ini.</div>
                        @else
                        @foreach ($siswaData as $index => $siswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>
                                    <button class="btn btn-warning edit-button btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $siswa->id }}">
                                        <i class="bi bi-pen"></i> 
                                    </button>
                                    <form action="{{ route('student.destroy', $siswa->id) }}" method="POST" class="deleteStudent" onclick="confirmDel({{ $siswa->id }})" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="bi bi-trash"></i>
                                        </button>
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
        document.querySelectorAll('.deleteStudent').forEach(link => {
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