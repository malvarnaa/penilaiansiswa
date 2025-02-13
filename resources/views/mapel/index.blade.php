<x-layout>
    @section('title', 'Data Mata Pelajaran - GradeFlow')

    @if(auth()->user()->role == 'admin')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Mata Pelajaran</h2>
        <a href="{{ route('admin.dataMaster') }}" class="btn btn-secondary">Kembali</a>
    </div> 

    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <label for="jurusanSelect" class="form-label fw-bold">Pilih Program Keahlian</label>
                <div class="input-group">
                    <select name="jurusan_id" id="jurusanSelect" class="form-select">
                        <option value="">-- Pilih Program Keahlian --</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ $jurusanId == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->jurusan }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary px-3">
                        <i class="bi bi-search"></i>
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
                                <h5 class="mb-0">{{ $namaMapel }}</h5>
                            </div>
                            <a href="{{ route('mapel.showGuru', ['mapel' => $namaMapel, 'jurusan_id' => $jurusanId]) }}" class="btn btn-light">                                Lihat Guru
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>        
    </div>
    @endif


    @if(auth()->user()->role == 'guru')
    <div class="container mt-4">
        <h2 class="mb-4">Mata Pelajaran yang Diajarkan oleh {{ auth()->user()->guru->nama }}</h2>

        @if ($mapel->isEmpty())
            <div class="alert alert-warning text-center">Belum ada mata pelajaran yang Anda ajar.</div>
        @else
            @foreach($mapel as $mataPelajaran)
                @php
                    $kelas = App\Models\Kelas::find($mataPelajaran->guruMapel->pluck('kelas_id')->unique()->first());
                @endphp

                @if ($kelas)
                    <div class="card shadow-sm mb-3 border-0">
                        <div class="card-body p-4" style="background-color: #435ebe; border-radius: 10px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Mata Pelajaran -->
                                <h5 class="text-white mb-0">{{ $mataPelajaran->mapel }}</h5>

                                <!-- Button Container -->
                                <div class="d-flex flex-column align-items-end">
                                    <!-- Tujuan Pembelajaran -->
                                    <a href="{{ route('cp.index', ['mapel_id' => $mataPelajaran->id]) }}" class="btn btn-outline-light fw-bold mb-2">
                                        Tujuan Pembelajaran
                                    </a>

                                    <!-- Lihat Kelas -->
                                    <a href="{{ route('kelas.show', ['kelas' => $kelas->id]) }}" class="btn btn-light fw-bold rounded-pill">
                                        {{ $kelas->kelas }} {{ $kelas->no_jrs }} {{ $kelas->kode_jurusan }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endif



    @include('mapel.create')
    @include('mapel.jurusanCreate')
</x-layout>
