<x-layout>

    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Daftar Guru untuk Mapel: {{ $mapel->mapel }}</h2>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>  

    @if($jurusanId)
    @php
        $jurusan = \App\Models\Jurusan::find($jurusanId)->jurusan ?? 'Tidak Ditemukan';
    @endphp
    <p>Program Keahlian : {{ $jurusan }}</p>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP/NUPTK</th>
                <th>Nama Guru</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gurus as $guru)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $guru->nomor }}</td>
                <td>{{ $guru->nama }}</td>
                <td>
                    @foreach($guru->kelas as $index => $kelas)
                    {{ $kelas->kelas }} {{ $kelas->kode_jurusan }} {{ $kelas->no_jrs }}
                    @if($index < $guru->kelas->count() - 1) 
                        ,
                    @endif
                @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</x-layout>