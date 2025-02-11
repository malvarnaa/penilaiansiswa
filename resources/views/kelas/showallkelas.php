<x-layout>
    <h2 class="mt-4">Semua Data Kelas</h2>

    <div class="card-body d-flex flex-wrap">
        @foreach($kelas as $data)
            <div class="card mb-3 me-3 shadow-sm" style="padding: 20px; background-color: #435ebe; border-radius: 10px; flex: 1 1 calc(33.333% - 1rem); color: white;">
                <h5>{{ $data->kelas }} - {{ $data->nama_jrs }}</h5>
                <p>{{ $data->jurusan->jurusan }}</p>
            </div>
        @endforeach
    </div>
</x-layout>
