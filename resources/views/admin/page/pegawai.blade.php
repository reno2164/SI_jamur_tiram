@extends('admin.layout.index')

@section('content')
<main class="container mt-4">
    <div class="row align-items-center mb-3">
        <div class="col">
            <h2 class="m-0">Data Pegawai</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('pegawai.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Tambah Pegawai</a>
        </div>
    </div>
    <div class="card border shadow-sm rounded">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No. telpon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawai as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->alamat }}</td>
                            <td>{{ $k->no_telpon }}</td>
                            <td>
                                <a href="{{ route('pegawai.edit', $k->id) }}" class="btn btn-sm btn-warning"><i
                                        class="fa fa-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $k->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="deleteModal{{ $k->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $k->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $k->id }}">Konfirmasi
                                            Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus pegawai ini?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('pegawai.destroy', $k->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>

                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
