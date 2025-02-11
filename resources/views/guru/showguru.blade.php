@if($data)
        <div class="modal fade" id="showModal{{ $data->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showModalLabel{{ $data->id }}">Detail Data Guru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Nama</th>
                                        <td>: {{ $data->nama ?? 'Tidak ada nama' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Login Sebagai</th>
                                        <td>: {{ $data->user->role ?? 'Tidak ada role' }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIP/NUPTK</th>
                                        <td>: {{ $data->nomor ?? 'Tidak ada NIP/NUPTK' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas yang Diajar</th>
                                        <td>: 
                                            @if($data->kelas && $data->kelas->count() > 0)
                                                {{ $data->kelas->pluck('kelas')->join(', ') }}
                                            @else
                                                Tidak ada kelas yang diajar
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mata Pelajaran yang Diajar</th>
                                        <td>: 
                                            @if($data->mapel && $data->mapel->count() > 0)
                                                {{ $data->mapel->pluck('mapel')->join(', ') }}
                                            @else
                                                Tidak ada mata pelajaran yang diajar
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif