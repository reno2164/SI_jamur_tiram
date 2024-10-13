<?php

namespace App\Http\Controllers;
use App\Models\Product; 
use Illuminate\Routing\Controller as BaseController;
class Controller extends BaseController
{
    public function index()
    {
        return view('pelanggan.page.home',['title'=> 'home']);
    }
    public function shop()
    {
        $data = Product::paginate(perPage: 5);
        return view('pelanggan.page.shop',[
            'data' => $data,
            'title'=> 'shop'
        ]);
    }
    public function contact()
    {
        return view('pelanggan.page.contact',['title'=> 'shop']);
    }
    public function transaksi()
    {
        return view('pelanggan.page.transaksi',['title'=> 'shop']);
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
