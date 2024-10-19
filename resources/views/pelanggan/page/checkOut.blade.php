@extends('pelanggan.layout.index')

@section('content')
    <style>
        .checkout-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkout-header {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .checkout-header h3 {
            font-weight: 700;
        }

        .checkout-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .checkout-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .checkout-item-details {
            flex-grow: 1;
            margin-left: 15px;
        }

        .checkout-summary {
            margin-top: 30px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkout-summary h4 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .checkout-summary p {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total-price {
            font-size: 24px;
            font-weight: 700;
            color: #28a745;
        }

        .btn-checkout {
            background-color: #28a745;
            color: white;
            font-size: 18px;
            font-weight: 600;
            padding: 15px;
            border-radius: 8px;
            width: 100%;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-checkout:hover {
            background-color: #218838;
        }

        .form-control {
            margin-bottom: 15px;
        }
    </style>

<div class="checkout-container">
    <div class="checkout-header text-center">
        <h3>Checkout</h3>
    </div>

    <!-- List of items -->
    <div class="checkout-items">
        <div class="checkout-item">
            <!-- Menampilkan gambar produk dari keranjang -->
            
            <div class="checkout-item-details">
                <!-- Menampilkan nama produk -->
                <h5></h5>
                <!-- Menampilkan harga produk -->
                <p class="text-muted">Harga: Rp </p>
                <!-- Menampilkan jumlah produk yang dibeli -->
                <p>Jumlah: {{ $qtyOrder }}</p>
            </div>
            <!-- Menampilkan total harga berdasarkan harga per item * jumlah -->
            <p>Rp </p>
        </div>
    </div>

    <!-- Summary section -->
    <div class="checkout-summary">
        <h4>Ringkasan Pesanan</h4>
        <p>Code Transaksi <span>{{$codeTransaksi}}</span></p>
        <p>Ongkos Kirim <span>Rp 0</span></p>
        <p>Diskon <span>- Rp {{$jumlahbarang}}</span></p>
        <hr>
        <p class="total-price">Total <span>Rp {{$detailBelanja}}</span></p>
    </div>

    <!-- Form untuk pengiriman dan pembayaran -->
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="address">Alamat Pengiriman</label>
            <input type="text" class="form-control" name="address" id="address" required>
        </div>

        <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="tel" class="form-control" name="phone" id="phone" required>
        </div>

        <div class="form-group">
            <label for="payment-method">Metode Pembayaran</label>
            <select class="form-control" name="payment_method" id="payment-method" required>
                <option value="bank_transfer">Transfer Bank</option>
                <option value="credit_card">Kartu Kredit</option>
                <option value="gopay">GoPay</option>
                <option value="ovo">OVO</option>
            </select>
        </div>

        <button type="submit" class="btn-checkout mt-4">Bayar Sekarang</button>
    </form>
</div>
@endsection
