<?php

namespace App\Http\Controllers;


use App\Models\cart;
use App\Models\Product;
use App\Models\pembelian;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $data = Product::latest()->paginate(10);
        $best = product::where('qty_out', '>=', 5)->get();
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();
        return view('pelanggan.page.home', [
            'title' => 'home',
            'count' => $countKeranjang,
            'data' => $data,
            'best' => $best,
        ]);
    }
    public function shop()
    {
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();

        $data = Product::paginate(perPage: 10);
        return view('pelanggan.page.shop', [
            'data' => $data,
            'count'     => $countKeranjang,
            'title' => 'shop'
        ]);
    }
    public function contact()
    {
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();
        return view('pelanggan.page.contact', ['title' => 'shop', 'count' => $countKeranjang,]);
    }
    public function keranjang()
    {
        $db = cart::with('product')->where(['idUser' => 'guest123', 'status' => 0])->get();
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();

        return view('pelanggan.page.keranjang', [
            'title'     => 'Keranjang',
            'count'     => $countKeranjang,
            'data'      => $db
        ]);
    }
    public function admin()
    {
        return view('admin.page.dashboard', [
            'name' => 'Dashboard',
            'title' => 'Admin'
        ]);
    }
    public function product()
    {
        return view('admin.page.index', [
            'name' => 'Dashboard',
            'title' => 'Admin'
        ]);
    }
    public function pegawai()
    {
        return view('admin.page.index', [
            'name' => 'Dashboard',
            'title' => 'Admin'
        ]);
    }
    public function pelanggan()
    {
        return view('admin.page.index', [
            'name' => 'Dashboard',
            'title' => 'Admin'
        ]);
    }
    public function dataPenjualan()
    {
        return view('admin.page.dataPenjualan', [
            'name' => 'Data Penjualan',
            'title' => 'data Penjualan'
        ]);
    }
    public function checkOut()
    {
        
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();
        // dd($db);die;
        $code = Pesanan::count();
        $codeTransaksi = date('Ymd') . $code + 1;
        $detailBelanja = pembelian::where(['id_pembelian' => $codeTransaksi, 'status' => 0])
            ->sum('price');
        $jumlahBarang = pembelian::where(['id_pembelian' => $codeTransaksi, 'status' => 0])
            ->count('id_product');
        $qtyBarang = pembelian::where(['id_pembelian' => $codeTransaksi, 'status' => 0])
            ->sum('qty');

        return view('pelanggan.page.checkOut', [
            'name' => 'checkOut',
            'title' => 'Checkout',
            'count' => $countKeranjang,
            'detailBelanja' => $detailBelanja,
            'jumlahbarang' => $jumlahBarang,
            'qtyOrder'  => $qtyBarang,
            'codeTransaksi' => $codeTransaksi,
        ]);
    }
    public function prosescheckOut(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);die;
        $code = Pesanan::count();
        $codeTransaksi = date('Ymd') . $code + 1;
        
        $pesanan = new pembelian();
        $fieldpesanan = [
            'id_pembelian' => $codeTransaksi,
            'id_product'    => $data['idBarang'],
            'qty'          => $data['qty'],
            'price'        => $data['total'],
            'status'       => 1,
        ];
        $pesanan::create($fieldpesanan);

        $fieldCart = [
            'qty'          => $data['qty'],
            'price'        => $data['total'],
            'status'       => 1,
        ];
        cart::where('id', $id)->update($fieldCart);

        return redirect()->route('checkOut', ['id' => $id]);
    }
}
