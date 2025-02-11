<x-layout>

    <div class="">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <h2>File yang Sudah Di-upload</h2>
            <a href="{{ route('tp.hasilunduhan') }}" class="btn btn-secondary">Kembali</a>
        </div>  
        <div class="card">
            <form action="{{ route('tp.hasilunduhan') }}"></form>
            <div class="card-body">
                @if ($file->isEmpty())
                    <div class="alert alert-warning">Belum ada file yang di-upload.</div>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama File</th>
                                <th>Di-upload Oleh</th>
                                <th>Tanggal</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($file as $key => $upload)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $upload->file_name }}</td>
                                    <td>{{ $upload->user->name }}</td>
                                    <td>{{ $upload->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ asset('storage/' . $upload->file_path) }}" class="btn btn-success btn-sm" download>
                                                <i class="bi bi-download"></i>
                                            </a>
                                            <form action="{{ route('admin.show', $upload->id) }}" target="_blank" class="mx-1">
                                                <button class="btn btn-info detail-button btn-sm">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </form>
                                            @if(auth()->user()->role == 'admin') 
                                            <form action="{{ route('admin.delete', $upload->id) }}" method="POST" onclick="confirmDel({{ $upload->id }})" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>                                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            </div>
        </div>

</x-layout>