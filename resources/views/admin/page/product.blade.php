@extends('admin.layout.index')

@section('content')
<div class="card rounded-full">
    <div class="card-header bg-transparent d-flex justify-content-between">
        <a href="{{route('product.create')}}" class="btn btn-info">
            <i class="fa fa-plus">
                <span>Tambah Product</span>
            </i>
        </a>
        <input type="text" wire:model="search" class="form-control w-25" placeholder="Search....">
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">no</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga/kg</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $no=>$product)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td class="text-center">
                            <img src="{{ asset('/storage/products/' . $product->image) }}" class="rounded"
                                style="width: 150px">
                        </td>
                        <td>{{ $product->title }}</td>
                        <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                        <td>{{ $product->stok }}</td>
                        <td class="">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                action="{{ route('product.destroy', $product->id) }}" method="POST">
                                <a href="{{ route('product.show', $product->id) }}"
                                    class="btn btn-sm btn-dark"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('product.edit', $product->id) }}"
                                    class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger">
                        Data Products belum Tersedia.
                    </div>
                @endforelse
            </tbody>
        </table>
        <div class="pagination d-flex flex-row justify-content-between">
            <div class="showData">
                Data ditampilkan {{ $products->count() }} dari {{ $products->total() }}
            </div>
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    //message with sweetalert
    @if (session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection