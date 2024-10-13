@extends('pelanggan.layout.index')

@section('content')
    <div class="d-flex flex-row gap-2 mt-4">
        <div class="d-flex flex-wrap gap-4 mb-5" id="filterResult">
            @if ($data->isEmpty())
                <h1>Belum ada product ...!</h1>
            @else
                @foreach ($data as $p)
                    <div class="card" style="width:200px;">
                        <div class="card-header m-auto">
                            <img src="{{ asset('storage/products/' . $p->image) }}"
                                alt="baju 1" style="width: 100%;height:130px; object-fit: cover; padding:0;">
                        </div>
                        <div class="card-body">
                            <p class="m-0 text-justify" style="font-size: 14px;">{{$p->title}}</p>
                            <p class="m-0"><i class="fa-regular fa-star"></i> 5+</p>
                        </div>
                        <div class="card-footer d-flex flex-row justify-content-between align-items-center">
                            <p class="m-0" style="font-size: 12px; font-weight:600;"><span>Rp
                                </span>{{number_format($p->price)}}</p>
                            <button class="btn btn-outline-primary" style="font-size:14px">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
    <div class="pagination d-flex flex-row justify-content-between">
        <div class="showData">
            Data ditampilkan {{ $data->count() }} dari {{ $data->total() }}
        </div>
        <div>
            {{ $data->links() }}
        </div>
    </div>
    @endif
@endsection
