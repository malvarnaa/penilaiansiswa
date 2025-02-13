<x-layout>

    <h2 class="mt-4">{{ $title }}</h2>

    <div class="card mt-4">
        <div class="card-body">
            @if(auth()->user()->role == 'admin')
            <button class="btn btn-primary d-flex ms-auto" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#createModal">Tambah</button>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-striped" style="font-size: 12px;">
                <thead style="text-align: center">
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </thead>
                <tbody style="text-align: center">
                    @if ($datasiswa->isEmpty())
                    <tr>
                        <td colspan="6">Tidak ada data yang harus ditampilkan.</td> <!-- Sesuaikan colspan -->
                    </tr>
                    @endif
                    @foreach ($datasiswa as $no => $data)
                    <tr>
                        <td>{{ $no+1 }}.</td>
                        <td>{{ $data->nis }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ optional($data->kelas)->kelas ?? 'Belum ada kelas' }}</td>
                        <td>{{ $data->jk }}</td>
                        <td>
                            <button class="btn btn-warning edit-button btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $data->id }}">
                                <i class="bi bi-pen"></i> 
                            </button>
                            <button class="btn btn-info detail-button btn-sm" data-bs-toggle="modal" data-bs-target="#showModal" data-id="{{ $data->id }}">
                                <i class="bi bi-eye"></i>
                            </button>
                            <form action="{{ route('guru.destroy', $data->id) }}" method="POST" id="deleteBrg" class="deleteForm" onclick="confirmDel({{ $data->id }})" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
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

    @include('siswa.create')

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
    </script>
</x-layout>