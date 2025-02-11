@foreach ($jurusans as $jurusan)
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @method('PUT')
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Program Keahlian</label>
                    <input type="text" class="form-control" id="jurusan" value="{{ $jurusan->jurusan }}" name="jurusan" required>
                </div>
                
                <div id="kode_jurusan_container" class="mb-3">
                    <label for="kode_jurusan" class="form-label">Konsentrasi Keahlian</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control kode_jurusan" value="{{ $jurusan->kode_jurusan }}" name="kode_jurusan[]" data-role="tagsinput" placeholder="PPLG, GIM, DKV" required>
                        <button type="button" class="btn btn-outline-secondary add-input-btn">+</button>
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