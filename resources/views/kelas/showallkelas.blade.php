<x-layout>
    @section('title', 'Data Semua Kelas - GradeFlow')
   <div class="d-flex justify-content-between align-items-center mt-2 mb-4">
        <h2 class="mt-4">Data Semua Kelas</h2>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card-body">
        <div class="row">
            @if ($kelas->isEmpty())
                <div class="alert alert-warning">Belum ada data kelas.</div>
            @else
                <div class="row">
                    @foreach ($kelas as $data)
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0" style="border-radius: 10px;">
                                <div class="card-body" style="background-color: #435ebe; color: white; border-radius: 10px;">
                                    <h5 class="card-title">{{ $data->kelas }} {{ $data->kode_jurusan }} {{ $data->no_jrs }}</h5>
                                    <p>Jumlah Siswa : </p>
                                    <a href="{{ route('kelas.siswa', ['kelas' => $data->id]) }}" class="btn btn-light rounded-pill">Lihat Data</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>
