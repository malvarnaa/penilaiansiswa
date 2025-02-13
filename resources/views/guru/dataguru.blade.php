<x-layout>
    @section('title', 'Data Guru - GradeFlow')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>{{ $title }}</h2>
        <a href="{{ route('admin.dataMaster') }}" class="btn btn-secondary">Kembali</a>
    </div>  

    <div class="card mt-4">
        <div class="card-body">
            @if(auth()->user()->role == 'admin')
            <button class="btn btn-primary d-flex ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">Tambah</button>
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
                    <th>NIP/NUPTK</th>
                    <th>Nama</th>
                    <th>Kelas yang diajar</th>
                    <th>Mata Pelajaran yang diajar</th>
                    <th>Aksi</th>
                </thead>
                <tbody style="text-align: center">
                    @if ($gurus->isEmpty())
                    <tr>
                        <td colspan="6">Tidak ada data yang harus ditampilkan.</td> 
                    </tr>
                    @endif
                    @foreach ($gurus as $no => $data)
                    <tr>
                        <td>{{ $no+1 }}.</td>
                        <td>{{ $data->nomor }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>
                            @if($data->kelas && $data->kelas->count() > 0)
                                @foreach($data->kelas as $index => $kelas)
                                    {{ $kelas->kelas }} {{ $kelas->kode_jurusan }} {{ $kelas->no_jrs }}
                                    @if($index < $data->kelas->count() - 1) 
                                        ,
                                    @endif
                                @endforeach
                            @else
                                <p>Tidak ada kelas yang diajarkan.</p>
                            @endif
                        </td>
                        <td>
                            @if($data->mapel && $data->mapel->count() > 0)
                                {{ $data->mapel->pluck('mapel')->join(', ') }}
                            @else
                                Tidak ada mata pelajaran yang diajar
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning edit-button btn-sm" data-bs-toggle="modal" data-bs-target="#editGuruModal" data-id="{{ $data->id }}">
                                <i class="bi bi-pen"></i> 
                            </button>
                            <form action="{{ route('guru.destroy', $data->id) }}" method="POST" class="deleteGuru" onclick="confirmDel({{ $data->id }})" style="display:inline;">
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


    {{-- createdata --}}

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('guru.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="createModalLabel">Tambah Data Guru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input NIP/NUPTK -->
                        <div class="mb-3">
                            <label for="nomor" class="form-label">NIP/NUPTK</label>
                            <input type="text" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" value="{{ old('nomor') }}" placeholder="KETIK NIP/NUPTK" required>
                            @error('nomor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
    
                        <!-- Input Nama Guru -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Guru</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="KETIK NAMA GURU" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
    
                        <!-- Select Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('jk') is-invalid @enderror" id="jk" name="jk" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki - laki" {{ old('jk') == 'Laki - laki' ? 'selected' : '' }}>Laki - laki</option>
                                <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
    
                        <div id="kelas-mapel-container">
                            <div class="kelas-mapel-group">
                                <div class="mb-3">
                                    <label for="jurusan_id" class="form-label">Program Keahlian</label>
                                    <select class="form-select jurusan-select" name="jurusan_id[]" required onchange="loadKelasMapel(this)">
                                        <option value="" selected disabled>Pilih Program Keahlian</option>
                                        @foreach ($jurusan as $jrs)
                                            <option value="{{ $jrs->id }}">{{ $jrs->jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kelas yang Diajar</label>
                                    <select class="form-select kelas-select" name="kelas_id[]" required>
                                        <option value="" selected disabled>Pilih Kelas</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mata Pelajaran</label>
                                    <select class="form-select mapel-select" name="mapel_id[]" required>
                                        <option value="" selected disabled>Pilih Mata Pelajaran</option>
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <!-- Tombol Tambah Grup -->
                        <button type="button" class="btn btn-success btn-sm" id="add-kelas-mapel">+</button>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- @include('guru.showguru', ['data' => $gurus]) --}}
    @include('guru.editdata')

    <script>
        document.getElementById('add-kelas-mapel').addEventListener('click', function () {
            let container = document.getElementById('kelas-mapel-container');
            let newGroup = document.createElement('div');
            newGroup.classList.add('kelas-mapel-group');
        
            newGroup.innerHTML = `
                <div class="mb-3">
                    <label class="form-label">Program Keahlian</label>
                    <select class="form-select jurusan-select" name="jurusan_id[]" required onchange="loadKelasMapel(this)">
                        <option value="" selected disabled>Pilih Jurusan</option>
                        @foreach ($jurusan as $data)
                            <option value="{{ $data->id }}">{{ $data->jurusan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelas yang Diajar</label>
                    <select class="form-select kelas-select" name="kelas_id[]" required>
                        <option value="" selected disabled>Pilih Kelas</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <select class="form-select mapel-select" name="mapel_id[]" required>
                        <option value="" selected disabled>Pilih Mata Pelajaran</option>
                    </select>
                </div>
            `;
        
            container.appendChild(newGroup);
        });
        
        function loadKelasMapel(selectElement) {
            let jurusanId = selectElement.value;
            let parentGroup = selectElement.closest('.kelas-mapel-group');
            let kelasSelect = parentGroup.querySelector('.kelas-select');
            let mapelSelect = parentGroup.querySelector('.mapel-select');
        
            kelasSelect.innerHTML = '<option value="" selected disabled>Memuat...</option>';
            mapelSelect.innerHTML = '<option value="" selected disabled>Memuat...</option>';
        
            fetch(`/get-kelas-mapel/${jurusanId}`)
                .then(response => response.json())
                .then(data => {
                    kelasSelect.innerHTML = '<option value="" selected disabled>Pilih Kelas</option>';
                    mapelSelect.innerHTML = '<option value="" selected disabled>Pilih Mata Pelajaran</option>';
        
                    data.kelas.forEach(kelas => {
                        kelasSelect.innerHTML += `<option value="${kelas.id}">${kelas.kelas} ${kelas.kode_jurusan} ${kelas.no_jrs}</option>`;
                    });
        
                    data.mapel.forEach(mapel => {
                        mapelSelect.innerHTML += `<option value="${mapel.id}">${mapel.mapel}</option>`;
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        document.querySelectorAll('.deleteGuru').forEach(link => {
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
