<x-layout>
    <h2 class="mt-4">{{ $judul }}</h2>

    <div class="card">
        <div class="card-body">
            @if(auth()->user()->role == 'guru')
            <button class="btn btn-primary d-flex ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">Tambah</button>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-striped">
                <thead style="text-align: center">
                    <th>TP</th>
                    <th>Tujuan Pembelajaran</th>
                </thead>
                <tbody style="text-align: center">
                    @if ($tp->isEmpty())
                    <tr>
                        <td colspan="5">Tidak ada data yang harus ditampilkan.</td> <!-- Sesuaikan colspan -->
                    </tr>
                    @endif
                    @foreach ($tp as $no => $data)
                    <tr>
                        <td>{{ $data->no_tp }}</td>
                        <td>{{ $data->nama_tp }}</td>
                        {{-- <td>
                            <button class="btn btn-warning edit-button btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $data->id }}">
                                <i class="bi bi-pen"></i> 
                            </button>
                            <button class="btn btn-info detail-button btn-sm" data-bs-toggle="modal" data-bs-target="#showModal" data-id="{{ $data->id }}">
                                <i class="bi bi-eye"></i>
                            </button>
                            <form action="{{ route('guru.destroy', $data->id) }}" method="POST" id="deleteBrg" onclick="confirmDel({{ $data->id }})" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('tp.create')
    {{-- @include('guru.editdata') --}}
</x-layout>
