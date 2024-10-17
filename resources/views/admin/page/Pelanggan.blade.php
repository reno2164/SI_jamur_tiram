@extends('admin.layout.index')

@section('content')
    <main class="container mt-4">
        <div class="row align-items-center mb-3">
            <div class="col text-center"> 
                <h2 class="m-0 font-weight-bold" style="font-size: 36px;">Data Pelanggan</h2> 
            </div>
            <div class="col-auto">
                <a href="{{ route('pelanggan.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Tambah pelanggan</a>
            </div>
        </div>
        <div class="card border shadow-sm rounded">
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->alamat }}</td> 
                                <td>{{ $p->no_telpon }}</td>
                                <td>
                                    <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-sm btn-warning"><i
                                            class="fa fa-pencil"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $p->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $p->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $p->id }}">Konfirmasi
                                                Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus pegawai ini?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST">
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
