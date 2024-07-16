<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengeluaranController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kartu = Kartu::all();
        $pengeluaran = Pengeluaran::latest()->get();
        confirmDelete('Hapus Pengeluaran!', 'Apakah Anda Yakin?');

        return view('user.pengeluaran.index', compact('pengeluaran', 'kartu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kartu = Kartu::all();
        $pengeluaran = Pengeluaran::all();
        return view('user.pengeluaran.create', compact('pengeluaran', 'kartu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_pengeluaran' => 'required',
            'deskripsi' => 'required',
            'id_kartu' => 'required',
        ]);

        $pengeluaran = new Pengeluaran();
        $pengeluaran->jumlah_pengeluaran = $request->jumlah_pengeluaran;
        $pengeluaran->deskripsi = $request->deskripsi;
        $pengeluaran->id_kartu = $request->id_kartu;

        $kartu = Kartu::find($request->id_kartu);
        $kartu->total -= $request->jumlah_pengeluaran;
        $kartu->save();

        $pengeluaran->save();
        Alert::success('Success', 'Pengeluaran Berhasil Dibuat.')->autoClose(1500);

        return redirect()->route('home');

        // if ($kartu->total < $request->jumlah_pengeluaran) {
        //     Alert::warning('Warning', 'Saldo anda tidak mencukupi')->autoClose(1500);
        //     return redirect()->route('pengeluaran.create');
        // } else {
        //     $kartu->total -= $request->jumlah_pengeluaran;
        //     $kartu->save();
        //     $pengeluaran->save();
        //     Alert::success('Success', 'Pengeluaran Berhasil Ditambahkan.')->autoClose(1500);

        //     return redirect()->route('pengeluaran.index');
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kartu = Kartu::all();
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('user.pengeluaran.edit', compact('pengeluaran', 'kartu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_pengeluaran' => 'required',
            'deskripsi' => 'required',
            'id_kartu' => 'required',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $kartu = $pengeluaran->kartu;
        $kartu->total = $kartu->total + $pengeluaran->jumlah_pengeluaran - $request->jumlah_pengeluaran;
        $kartu->save();

        $pengeluaran->update($request->all());
        Alert::success('Success', 'Pengeluaran Berhasil Diedit.')->autoClose(1500);

        return redirect()->route('pengeluaran.index');

        // $pengeluaran = Pengeluaran::findOrFail($id);
        // $pengeluaran->jumlah_pengeluaran = $request->jumlah_pengeluaran;
        // $pengeluaran->deskripsi = $request->deskripsi;
        // $pengeluaran->id_kartu = $request->id_kartu;
        // $pengeluaran->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $kartu = $pengeluaran->kartu;
        $kartu->total += $pengeluaran->jumlah_pengeluaran;
        $kartu->save();

        $pengeluaran->delete();

        Alert::success('Terhapus!', 'Data Pengeluaran Berhasil Dihapus')->autoClose(1500);

        return redirect()->route('pengeluaran.index');
    }
}
