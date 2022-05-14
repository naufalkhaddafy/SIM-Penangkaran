<?php

namespace App\Http\Controllers;
use App\Models\Produksi;
use App\Models\Penangkaran;
use Illuminate\Http\Request;

class HasilProduksiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ReportInkubator(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        return view('laporanproduksi.inkubator',$data);
    }
    public function ReportHidup(){
        $data=([
            'penangkarans' =>Penangkaran::all(),
            'produksis'=>Produksi::all(),
        ]);
        $tgl_today = \Carbon\Carbon::now(); // Tanggal sekarang
        return view('laporanproduksi.hidup',$data ,compact('tgl_today'));
    }
}