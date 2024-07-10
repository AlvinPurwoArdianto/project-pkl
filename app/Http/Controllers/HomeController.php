<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Kartu;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

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
        // $user = Auth::user();
        // if ($user->isAdmin == 1) {
        //     return view('home');
        // } else {
        //     return view('user.pemasukan.index');
        // }

        $kartu = Kartu::all();
        $pemasukan = Pemasukan::all();
        $pengeluaran = Pengeluaran::all();

        $saldo = Pemasukan::sum('jumlah_pemasukan') - Pengeluaran::sum('jumlah_pengeluaran');
        $allPemasukan = Pemasukan::sum('jumlah_pemasukan');
        $allPengeluaran = Pengeluaran::sum('jumlah_pengeluaran');

        confirmDelete('Hapus Kartu!', 'Apakah Anda Yakin?');

        return view('home', ['kartu' => $kartu, 'pemasukan' => $pemasukan, 'pengeluaran' => $pengeluaran, 'saldo' => $saldo, 'allPemasukan' => $allPemasukan, 'allPengeluaran' => $allPengeluaran]);
    }

    public function destroy($id)
    {
        $kartu = Kartu::findOrFail($id);
        $kartu->delete();
        Alert::success('Terhapus!', 'Data Berhasil Dihapus')->autoClose(1500);
        return redirect()->route('home');
    }
}
