<x-layout>
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Data Kelas {{ $kelas }}</h2>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>   

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="create" data-bs-toggle="modal" data-bs-target="#createModal">
        <div class="card-body">
            <div class="card mb-3 shadow-sm mx-auto card-transparent" style="width: 100%; padding: 15px; align-items: center;">
                <div class="icon-center">
                    <i class="bi bi-plus-square fs-1 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    @if ($kelasData->isEmpty())
        <div class="alert alert-warning">Belum ada data kelas.</div>
    @else
        <div class="row">
            @foreach ($kelasData as $data)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0" style="border-radius: 10px;">
                        <div class="card-body" style="background-color: #435ebe; color: white; border-radius: 10px;">
                            <h5 class="card-title">{{ $data->kelas }} {{ $data->kode_jurusan }} {{ $data->no_jrs }}</h5>
                            <p>Wali Kelas : </p>
                            <p>Jumlah Siswa : </p>
                            <a href="{{ route('kelas.siswa', ['kelas' => $data->id]) }}" class="btn btn-light rounded-pill">Lihat Data</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Modal Tambah Kelas -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('kelas.store', ['kelas' => $kelas]) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label">Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" class="form-select" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" data-nama="{{ $jurusan->jurusan }}">
                                        {{ $jurusan->jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kode_jurusan" class="form-label">Nama Kelas</label>
                            <select name="kode_jurusan" id="kode_jurusan" class="form-select" required>
                                <option value="">Pilih Kode Jurusan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="no_jrs" class="form-label">No Jurusan</label>
                            <input type="number" name="no_jrs" id="no_jrs" class="form-control" placeholder="Masukkan Nomor Jurusan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jurusanSelect = document.getElementById('jurusan_id');
            const namaJrsInput = document.getElementById('nama_jrs');
    
            // Fungsi membuat singkatan otomatis
            function getShortCode(jurusanName) {
                const kataPendek = ['dan']; // Kata-kata yang diabaikan
                const kataArray = jurusanName.split(' ').filter(word => !kataPendek.includes(word.toLowerCase()));
                return kataArray.map(word => word.charAt(0).toUpperCase()).join('');
            }
    
            // Saat jurusan berubah, isi otomatis tetapi tetap bisa diubah
            jurusanSelect.addEventListener('change', function() {
                const selectedOption = jurusanSelect.options[jurusanSelect.selectedIndex];
                const jurusanName = selectedOption.getAttribute('data-nama');
            
                // Buat singkatan otomatis
                const shortCode = getShortCode(jurusanName);
    
                // Isi input nama_jrs (tapi tetap bisa diubah)
                namaJrsInput.value = shortCode;
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
        const jurusanSelect = document.getElementById('jurusan_id');
        const kodeJurusanSelect = document.getElementById('kode_jurusan');

        const jurusanKodeMap = @json($jurusans->mapWithKeys(fn($j) => [$j->id => $j->kode_jurusan]));

        jurusanSelect.addEventListener('change', function() {
            const jurusanId = this.value;
            kodeJurusanSelect.innerHTML = '<option value="">Pilih Kode Jurusan</option>'; // Reset opsi

            if (jurusanKodeMap[jurusanId]) {
                const kodeJurusan = jurusanKodeMap[jurusanId].split(','); // Jika ada lebih dari satu kode
                kodeJurusan.forEach(kode => {
                    const option = document.createElement('option');
                    option.value = kode.trim();
                    option.textContent = kode.trim();
                    kodeJurusanSelect.appendChild(option);
                });
            }
        });
    });
    </script>
    
    
    
</x-layout>
