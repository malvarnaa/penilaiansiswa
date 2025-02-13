<x-layout>
    @section('title', 'Data Capaian Pembelajaran - GradeFlow')

    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Data Capaian Pembelajaran</h2>
        <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="container">
    
        <!-- Tambah CP -->
        <form action="{{ route('cp.store') }}" method="POST">
            @csrf
            <input type="hidden" name="mapel_id" value="{{ $mapel_id }}">
            <input type="hidden" name="guru_id" value="{{ auth()->user()->guru->id }}">
            <div class="input-group mb-3">
                <input type="text" name="nama_cp" class="form-control" placeholder="Nama Capaian Pembelajaran" required>
                <button type="submit" class="btn btn-primary">Tambah CP</button>
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
        @foreach($cp as $index => $capaian)
            <div class="card mt-3">
                <div class="card-header">
                    <b>{{ $index + 1 }}. {{ $capaian->nama_cp }}</b>
                    <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#addTpModal{{ $capaian->id }}">+ Tambah TP</button>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($capaian->tp as $tpIndex => $tp)
                            <li>{{ $index + 1 }}.{{ $tpIndex + 1 }} - {{ $tp->nama_tp }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
    
            <!-- Modal Tambah TP -->
            <div class="modal fade" id="addTpModal{{ $capaian->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('tp.store', $capaian->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Tujuan Pembelajaran</h5>
                            </div>
                            <div class="modal-body">
                                <div id="tpFields">
                                    <input type="text" name="nama_tp[]" class="form-control mb-2" placeholder="Nama Tujuan Pembelajaran">
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary" onclick="addTpField()">+ Tambah TP</button>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    
    <script>
    function addTpField() {
        let input = document.createElement('input');
        input.type = 'text';
        input.name = 'nama_tp[]';
        input.className = 'form-control mb-2';
        input.placeholder = 'Nama Tujuan Pembelajaran';
        document.getElementById('tpFields').appendChild(input);
    }
    </script>

</x-layout> 