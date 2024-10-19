@extends('pelanggan.layout.index')

@section('content')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Custom styling for buttons */
        .minus,
        .plus {
            font-size: 16px;
            padding: 8px;
            cursor: pointer;
        }

        .card-body {
            align-items: center;
        }

        .btn-danger {
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #dc3545;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .card-body {
                flex-direction: column;
            }

            img {
                width: 100%;
            }
        }
    </style>

    <!-- Page Title -->
    <div class="container mt-5">
        <h3 class="mb-5 text-center">Keranjang Belanja</h3>

        @if ($data->isEmpty())
            <h4 class="text-center">Keranjang Anda Kosong</h4>
        @else
            @foreach ($data as $x)
                <div class="card mb-3">
                    <div class="card-body d-flex gap-4">
                        <img src="{{ asset('storage/products/' . $x->product->image) }}" width="300" alt="">
                        <form action="{{ route('prosescheckOut', ['id' => $x->id]) }}" method="POST">
                            @csrf
                            <div class="desc w-100">
                                <p style="font-size:24px; font-weight:700;">{{ $x->product->title }}</p>
                                <input type="hidden" name="idBarang" value="{{ $x->product->id }}">
                                <input type="number" class="form-control border-0 fs-1" name="harga" id="harga"
                                    value="{{ $x->product->price }}">
                                <div class="row mb-2">
                                    <label for="qty" class="col-sm-2 col-form-label fs-5">Quantity</label>
                                    <div class="col-sm-5 d-flex">
                                        <button class="rounded-start bg-secondary p-2 border border-0 plus"
                                            id="plus">+</button>
                                        <input type="number" name="qty" class="form-control w-25 text-center qty"
                                            id="qty" name="qty" value="{{ $x->qty }}">
                                        <button class="rounded-end bg-secondary p-2 border border-0 minus" id="minus"
                                            disabled>-</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="price" class="col-sm-2 col-form-label fs-5">Total</label>
                                    <input type="text" class="col-sm-2 form-control w-25 border-0 fs-4 total"
                                        name="total" readonly id="total">
                                </div>
                                <div class="row w-50 gap-1">
                                    <button type="submit" class="btn btn-success col-sm-5">
                                        <i class="fa fa-shopping-cart"></i>
                                        Checkout
                                    </button>

                                    <button type="submit" class="btn btn-danger col-sm-5">
                                        <i class="fa fa-trash-alt"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <script>
        $(document).ready(function() {
            $(".plus").click(function(e) {
                e.preventDefault();
                var card = $(this).closest(".card-body");
                var harga = card.find("#harga").val();
                var qty = card.find("#qty").val();

                var tambah = parseInt(qty) + 1;
                card.find("#qty").val(tambah);

                var subtotal = parseInt(harga) * parseInt(tambah);
                card.find(".total").val(subtotal);

                if (qty > 0) {
                    card.find(".minus").prop("disabled", false);
                }
            });

            $(".minus").click(function(e) {
                e.preventDefault();
                var card = $(this).closest(".card-body");
                var harga = card.find("#harga").val();
                var qty = card.find("#qty").val();

                var tambah = parseInt(qty) - 1;
                card.find("#qty").val(tambah);

                var subtotal = parseInt(harga) * parseInt(tambah);
                card.find(".total").val(subtotal);

                if (qty <= 1) {
                    card.find(".minus").prop("disabled", true);
                }
            });

            $(".card-body").each(function() {
                var card = $(this);
                var harga = card.find("#harga").val();
                var qty = card.find("#qty").val();
                var total = parseInt(harga) * parseInt(qty);
                card.find("#total").val(total);
            });
        });
    </script>
@endsection
