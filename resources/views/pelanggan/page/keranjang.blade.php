@extends('pelanggan.layout.index')

@section('content')
    <style>
        /* Menghilangkan spinner pada input */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .card {
            border: none;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-body {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        img {
            width: 100%;
            max-width: 250px;
            height: auto;
            border-radius: 8px;
        }

        .desc {
            flex-grow: 1;
        }

        .desc p {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .row.mb-2,
        .row {
            align-items: center;
            margin-bottom: 10px;
        }

        .form-control.qty {
            max-width: 100px;
            text-align: center;
            margin-left: 10px;
        }

        .form-control.total {
            max-width: 150px;
            font-weight: bold;
            font-size: 18px;
            text-align: left;
        }

        /* Button Styling */
        .btn-success,
        .btn-danger {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-danger {
            background-color: #ff4c4c;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #dc3545;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .card-body {
                flex-direction: column;
                text-align: center;
            }

            img {
                max-width: 100%;
            }
        }
    </style>

    <!-- Judul Halaman -->
    <div class="container mt-5">
        <h3 class="mb-5 text-center">Keranjang Belanja</h3>

        @if ($data->isEmpty())
            <h4 class="text-center">Keranjang Anda Kosong</h4>
        @else
            @foreach ($data as $x)
                <div class="card mb-3">
                    <div class="card-body">
                        <img src="{{ asset('storage/products/' . $x->product->image) }}" alt="Gambar Produk">
                        <form action="{{ route('prosescheckOut', ['id' => $x->id]) }}" method="POST" class="desc">
                            @csrf
                            <p>{{ $x->product->title }}</p>
                            <input type="hidden" name="idBarang" value="{{ $x->product->id }}">
                            <input type="hidden" class="form-control border-0 fs-1" name="harga" id="harga"
                                value="2000" readonly>

                            <div class="row mb-2">
                                <label for="qty" class="col-sm-3 col-form-label fs-6">Jumlah (gram)</label>
                                <div class="col-sm-4">
                                    <input type="number" name="qty" class="form-control qty" id="qty"
                                        min="1" placeholder="Masukkan berat dalam gram" required>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="total" class="col-sm-3 col-form-label fs-5">Total</label>
                                <input type="text" class="form-control total" name="total" readonly id="total">
                            </div>

                            <div class="row gap-2">
                                <button type="submit" class="btn btn-success col-sm-5">
                                    <i class="fa fa-shopping-cart"></i> Checkout
                                </button>

                                <button type="submit" class="btn btn-danger col-sm-5">
                                    <i class="fa fa-trash-alt"></i> Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        $(document).ready(function() {
            $(".qty").on('input', function() {
                var qtyInput = $(this);
                var qty = parseInt(qtyInput.val());
    
                if (qty < 0 || isNaN(qty)) {
                    qty = 0;
                    qtyInput.val(qty);
                }
    
                var card = qtyInput.closest(".card-body");
                var hargaPer100Gram = parseInt(card.find("#harga").val());
                var total = (hargaPer100Gram / 100) * qty;
    
                card.find("#total").val(total);
            });
        });
    </script>
    
@endsection
