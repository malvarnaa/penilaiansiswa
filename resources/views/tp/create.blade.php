<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('tp.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="createModalLabel">Tambah Tujuan Pembelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="no_tp" class="form-label">TP (Auto-Generate)</label>
                        <input type="text" name="no_tp" id="no_tp" class="form-control" value="{{ $no_tp ?? '' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="nama_tp" class="form-label">Tujuan Pembelajaran</label>
                        <input type="text" class="form-control @error('nama_tp') is-invalid @enderror" id="nama_tp" name="nama_tp" value="{{ old('nama_tp') }}" required>
                        @error('nama_tp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
