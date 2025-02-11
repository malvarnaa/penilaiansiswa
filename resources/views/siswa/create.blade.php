<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('siswa.store')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title fs-5" id="createModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" name="kelas_id" id="kelas" required>
                                <option value="" selected disabled>Pilih Kelas</option>
                                @foreach ($kelas as $data)
                                    <option value="{{ $data->id }}" {{ old('kelas_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->kelas }} {{ $data->jurusan }}
                                    </option>
                                @endforeach
                            </select>                            
                        @error('kelas_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jk" name="jk" required>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>