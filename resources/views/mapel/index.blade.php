<x-layout>
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Mata Pelajaran</h2>
        <a href="{{ route('admin.dataMaster') }}" class="btn btn-secondary">Kembali</a>
    </div> 

    <form method="GET" class="mb-2">
        <div class="row g-2 align-items-center">
            <div class="col-md-12">
                <label for="jurusanSelect" class="form-label">Pilih Jurusan</label>
                <select name="jurusan_id" id="jurusanSelect" class="form-select">
                    <option value="">Pilih Program Keahlian</option>
                    @foreach($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ $jurusanId == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->jurusan }}
                        </option>
                    @endforeach
                </select>
                <div class="col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </div>
    </form>
    
        
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-md-12 mt-3">
        @if(auth()->user()->role == 'admin')
            <div class="create" data-bs-toggle="modal" data-bs-target="#createModal">
                <div class="card-body">
                    <div class="card mb-3 mt-5 shadow-sm mx-auto card-transparent" style="width: 100%; padding: 15px; align-items: center;">
                        <div class="icon-center">
                            <i class="bi bi-plus-square fs-1 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-12 mt-3">
            @if ($mapel->isEmpty())
                <div class="alert alert-warning">Belum ada mata pelajaran yang di-upload.</div>
            @else
                @foreach($mapel as $namaMapel => $dataMapel)
                    <div class="card mb-3 text-white shadow-sm" style="padding: 30px; background-color: #435ebe; border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">{{ $namaMapel }}</h5> <!-- Nama mapel dari grouping -->
                            </div>
                            <a href="{{ route('mapel.showGuru', ['mapel' => $namaMapel, 'jurusan_id' => $jurusanId]) }}" class="btn btn-light">
                                Lihat Guru
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>        
    </div>

    @include('mapel.create')
    @include('mapel.jurusanCreate')
</x-layout>
