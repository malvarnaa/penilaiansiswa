@foreach ( $gurus as $data )
<div class="modal fade" id="editGuruModal" tabindex="-1" aria-labelledby="editGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGuruModalLabel">Edit Data Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('guru.update', $data->id)}}" id="editGuruForm" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="editGuruId" name="id">

                    <div class="form-group">
                        <label for="nama">Nama Guru</label>
                        <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" placeholder="KETIK NAMA GURU" required>
                    </div>
                   <div class="form-group">
                        <label for="nomor" class="form-label">NIP/NUPTK</label>
                        <input type="text" class="form-control" name="nomor" value="{{ $data->nomor }}" placeholder="KETIK NOMOR" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="editJk" name="jk" required>
                            <option value="Laki - laki">Laki - laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div id="kelas-mapel-container">
                        <!-- Data Kelas dan Mapel Akan Dimuat dengan JavaScript -->
                    </div>

                    <button type="button" class="btn btn-success btn-sm" id="add-kelas-mapel">+</button>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let editGuruModal = document.getElementById('editGuruModal');
        editGuruModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-id');
            let nama = button.getAttribute('data-nama');
            let nomor = button.getAttribute('data-nomor');
            let jk = button.getAttribute('data-jk');
    
            document.getElementById('editGuruId').value = id;
            document.getElementById('editNama').value = nama;
            document.getElementById('editNomor').value = nomor;
            document.getElementById('editJk').value = jk;
    
            // Load data kelas, jurusan, mapel dari AJAX
            loadKelasMapel(id);
        });
    
        function loadKelasMapel(guruId) {
            fetch(`/guru/${guruId}/edit`)
                .then(response => response.json())
                .then(data => {
                    let container = document.getElementById('kelas-mapel-container');
                    container.innerHTML = '';
    
                    data.guru_mapel.forEach(function (item) {
                        let newGroup = document.createElement('div');
                        newGroup.classList.add('kelas-mapel-group');
    
                        newGroup.innerHTML = `
                            <div class="mb-3">
                                <label class="form-label">Program Keahlian</label>
                                <select class="form-select jurusan-select" name="jurusan_id[]" required>
                                    <option value="">Pilih Jurusan</option>
                                    ${data.jurusan.map(j => `<option value="${j.id}" ${j.id == item.jurusan_id ? 'selected' : ''}>${j.jurusan}</option>`).join('')}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kelas yang Diajar</label>
                                <select class="form-select kelas-select" name="kelas_id[]" required>
                                    <option value="">Pilih Kelas</option>
                                    ${data.kelas.map(k => `<option value="${k.id}" ${k.id == item.kelas_id ? 'selected' : ''}>${k.kelas}</option>`).join('')}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mata Pelajaran</label>
                                <select class="form-select mapel-select" name="mapel_id[]" required>
                                    <option value="">Pilih Mata Pelajaran</option>
                                    ${data.mapel.map(m => `<option value="${m.id}" ${m.id == item.mapel_id ? 'selected' : ''}>${m.mapel}</option>`).join('')}
                                </select>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-kelas-mapel">Hapus</button>
                        `;
    
                        container.appendChild(newGroup);
                    });
                });
        }
    
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-kelas-mapel')) {
                event.target.closest('.kelas-mapel-group').remove();
            }
        });
    });
    </script>
    