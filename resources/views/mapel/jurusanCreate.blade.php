<div class="modal fade" id="jurusanCreateModal" tabindex="-1" aria-labelledby="jurusanCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('jurusan.store') }}" id="jurusanForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="jurusanCreateModalLabel">Tambah Program Keahlian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Program Keahlian</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="KETIK PROGRAM KEAHLIAN" required>
                    </div>
                    
                    <div id="kode_jurusan_container" class="mb-3">
                        <label for="kode_jurusan" class="form-label">Konsentrasi Keahlian</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control kode_jurusan" name="kode_jurusan[]" data-role="tagsinput" placeholder="PPLG, GIM" required>
                            <button type="button" class="btn btn-outline-secondary add-input-btn">+</button>
                        </div>
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
    document.querySelector('.add-input-btn').addEventListener('click', function() {
        // Menambahkan kolom input baru
        const newInput = document.createElement('div');
        newInput.classList.add('input-group', 'mb-2');
        newInput.innerHTML = `
            <input type="text" class="form-control kode_jurusan" name="kode_jurusan[]" data-role="tagsinput" placeholder="PPLG, GIM, DKV" required>
            <button type="button" class="btn btn-outline-secondary remove-input-btn">-</button>
        `;
        
        // Menambahkan input baru ke dalam container
        document.getElementById('kode_jurusan_container').appendChild(newInput);
        
        // Menambahkan event listener untuk tombol "-" (hapus input)
        newInput.querySelector('.remove-input-btn').addEventListener('click', function() {
            newInput.remove();
        });
    });
</script>
