@foreach($siswaData as $siswa)
<div class="modal fade" id="editModal-{{ $siswa->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $siswa->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('student.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="kelas_id" value="{{ $siswa->kelas_id }}">
            <input type="hidden" name="jurusan_id" value="{{ $siswa->jurusan_id }}">
            
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel-{{ $siswa->id }}">Edit Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nis-{{ $siswa->id }}" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis-{{ $siswa->id }}" name="nis" value="{{ $siswa->nis }}" placeholder="KETIK NIS" required>
                    </div>
                    <div class="form-group">
                        <label for="nama-{{ $siswa->id }}">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama-{{ $siswa->id }}" name="nama" value="{{ $siswa->nama }}" placeholder="KETIK NAMA SISWA" required>
                    </div>
                    <div class="form-group">
                        <label for="jk-{{ $siswa->id }}" class="form-label">Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jkLaki-{{ $siswa->id }}" value="Laki-laki" {{ $siswa->jk == 'Laki-laki' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jkLaki-{{ $siswa->id }}">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jkPerempuan-{{ $siswa->id }}" value="Perempuan" {{ $siswa->jk == 'Perempuan' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jkPerempuan-{{ $siswa->id }}">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
