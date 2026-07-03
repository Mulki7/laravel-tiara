<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalMahasiswa = \App\Models\Mahasiswa::count();
        $totalJurusan = \App\Models\Mahasiswa::distinct('program_studi')->count('program_studi');
        $jurusanStats = \App\Models\Mahasiswa::select('program_studi', \DB::raw('count(*) as total'))
            ->groupBy('program_studi')
            ->get();
        $mahasiswaTerbaru = \App\Models\Mahasiswa::latest()->take(5)->get();

        return view('dashboard', compact('totalMahasiswa', 'totalJurusan', 'jurusanStats', 'mahasiswaTerbaru'));
    }
}
