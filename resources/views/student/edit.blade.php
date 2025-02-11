@foreach($siswaData as $siswa)
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ isset($siswa) ? route('student.update', $siswa->id) : '#' }}" method="POST">
            @csrf
            <input type="hidden" name="kelas_id" value="{{ $siswa->kelas_id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @method('PUT')
                    <div class="form-group">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" name="nis" value="{{ $siswa->nis }}" placeholder="KETIK NIS" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" class="form-control" name="nama" value="{{ $siswa->nama }}" placeholder="KETIK NAMA SISWA" required>
                    </div>
                    <div class="form-group">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jkLaki" value="Laki-laki" {{ $siswa->jk == 'Laki-laki' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jkLaki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="jkPerempuan" value="Perempuan" {{ $siswa->jk == 'Perempuan' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="jkPerempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endforeach