@extends('pelanggan.layout.index')

@section('content')
    <style>
        /* Styling for product cards */
        .product-card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Badge for discount or new product */
        .badge-new {
            background-color: #28a745;
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
        }

        /* Buttons styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #0056b3;
            color: white;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }

        /* Styling for pagination */
        .pagination {
            justify-content: center;
        }

        .pagination .page-link {
            color: #007bff;
            border: none;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #007bff;
            color: white;
        }
    </style>

    <div class="container mt-4">
        <!-- Section Title -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Belanja Produk Jamur Tiram</h2>
            <p class="text-muted">Temukan berbagai produk berkualitas dengan harga terbaik</p>
        </div>

        <!-- Product Grid -->
        <div class="row g-4" id="filterResult">
            @if ($data->isEmpty())
                <div class="col-12">
                    <h1 class="text-center">Belum ada produk ...!</h1>
                </div>
            @else
                @foreach ($data as $p)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card product-card border-0 shadow-sm position-relative" style="border-radius: 15px; overflow: hidden;">
                            <!-- Image Section -->
                            <div class="card-header p-0 position-relative">
                                <img src="{{ asset('storage/products/' . $p->image) }}" alt="{{ $p->title }}"
                                    class="img-fluid" style="height:200px; object-fit: cover;">
                                <!-- Example badge for new products -->
                                @if ($p->isNew)
                                    <span class="badge-new">Baru</span>
                                @endif
                            </div>

                            <!-- Body Section -->
                            <div class="card-body text-center p-3">
                                <h5 class="fw-bold">{{ $p->title }}</h5>
                                <p class="text-muted m-0" style="font-size: 14px;">
                                    <i class="fa-regular fa-star"></i> 5+ Reviews
                                </p>
                                <p class="text-primary m-0" style="font-size: 16px;">
                                    <span>Rp {{ number_format($p->price) }}</span>
                                </p>

                                <!-- Stock Section -->
                                <p class="text-success m-0" style="font-size: 14px;">
                                    Stok Tersedia: {{ $p->stok }} 
                                </p>
                            </div>

                            <!-- Footer Section (Buttons) -->
                            <div class="card-footer bg-white text-center p-3 border-0">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <!-- Button for add to cart -->
                                        <form action="{{ route('addTocarthome') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idProduct" value="{{ $p->id }}">
                                            <button type="submit" class="btn btn-outline-primary w-100" style="font-size:16px; padding:10px;">
                                                <i class="fa-solid fa-cart-plus fa-3x"></i>
                                            </button>
                                        </form>
                                    </div>
                            
                                    <div class="col-6">
                                        <!-- Button for product details -->
                                        <a href="{{ route('product.show', $p->id) }}" class="btn btn-outline-secondary w-100" style="font-size:16px; padding:10px;">
                                            <i class="fa-solid fa-info-circle"></i> Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between mt-5">
            <div class="showData">
                Data ditampilkan {{ $data->count() }} dari {{ $data->total() }}
            </div>
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>

@endsection
