<x-layout>

    <h2>Daftar Guru untuk Mapel: {{ $mapel->mapel }}</h2>

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
                <th>Nama Guru</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gurus as $index => $guru)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $guru->nama }}</td>
                <td>
                    @foreach($guru->kelas as $kelas)
                        {{ $kelas->nama }}@if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</x-layout>