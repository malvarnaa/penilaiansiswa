<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('mapel.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="createModalLabel">Tambah Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="mapel" name="mapel" placeholder="KETIK MAPEL" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konsentrasi Keahlian</label>
                    
                        <!-- Checkbox untuk memilih semua -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                            <label class="form-check-label" for="checkAll">
                                Pilih Semua
                            </label>
                        </div>
                    
                        <!-- Daftar jurusan -->
                        @foreach($jurusans as $jurusan)
                            <div class="form-check">
                                <input class="form-check-input jurusan-checkbox" type="checkbox" name="jurusan_id[]" value="{{ $jurusan->id }}" id="jurusan_{{ $jurusan->id }}">
                                <label class="form-check-label" for="jurusan_{{ $jurusan->id }}">
                                    {{ $jurusan->jurusan }}
                                </label>
                            </div>
                        @endforeach
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

<script>
    document.getElementById('checkAll').addEventListener('change', function () {
        let checkboxes = document.querySelectorAll('.jurusan-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
