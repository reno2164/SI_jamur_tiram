<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Product; 
use Illuminate\Routing\Controller as BaseController;
class Controller extends BaseController
{
    public function index()
    {
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();
        return view('pelanggan.page.home',[
            'title'=> 'home',
            'count' => $countKeranjang
        ]);
    }
    public function shop()
    {
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();
        
        $data = Product::paginate(perPage: 5);
        return view('pelanggan.page.shop',[
            'data' => $data,
            'count'     => $countKeranjang,
            'title'=> 'shop'
        ]);
    }
    public function contact()
    {
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();
        return view('pelanggan.page.contact',['title'=> 'shop', 'count'     => $countKeranjang,]);
    }
    public function transaksi()
    {
        $db = cart::with('product')->where(['idUser' => 'guest123', 'status' => 0])->get();
        $countKeranjang = cart::where(['idUser' => 'guest123', 'status' => 0])->count();

        // dd($db->product->nama_product);die;
        return view('pelanggan.page.transaksi', [
            'title'     => 'Transaksi',
            'count'     => $countKeranjang,
            'data'      => $db
        ]);
    }
    public function admin()
    {
        return view('admin.page.dashboard',[
            'name' => 'Dashboard',
            'title'=> 'Admin'
        ]);
    }
    public function product()
    {
        return view('admin.page.index',[
            'name' => 'Dashboard',
            'title'=> 'Admin'
        ]);
    }
    public function pegawai()
    {
        return view('admin.page.index',[
            'name' => 'Dashboard',
            'title'=> 'Admin'
        ]);
    }
    public function pelanggan()
    {
        return view('admin.page.index',[
            'name' => 'Dashboard',
            'title'=> 'Admin'
        ]);
    }
    public function dataPenjualan()
    {
        return view('admin.page.dataPenjualan',[
            'name' => 'Data Penjualan',
            'title'=> 'Admin'
        ]);
    }
}
