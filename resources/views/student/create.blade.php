<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('student.store') }}">
            @csrf
            <input type="hidden" name="kelas_id" value="{{ $kelasData->id }}">
            <input type="hidden" name="jurusan_id" value="{{ $jurusanData->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Tambah Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis[]" value="{{ old('nis') }}" placeholder="KETIK NIS" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama" name="nama[]" value="{{ old('nama') }}" placeholder="KETIK NAMA SISWA" required>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-select @error('jk') is-invalid @enderror" id="jk" name="jk[]" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki - laki" {{ old('jk') == 'Laki - laki' ? 'selected' : '' }}>Laki - laki</option>
                            <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jk') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('form').addEventListener('submit', function () {
            setTimeout(() => {
                this.reset(); // Reset form setelah submit
            }, 1000);
        });
    });
    </script>
    