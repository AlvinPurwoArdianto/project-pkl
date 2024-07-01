<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use NumberFormatter;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukan = Pemasukan::all();
        $kartu = Kartu::all();
        return view('pemasukan.index', compact('pemasukan', 'kartu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kartu = Kartu::all();
        $pemasukan = Pemasukan::all();
        return view('pemasukan.create', compact('pemasukan', 'kartu'));
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
            'jumlah_pemasukan' => 'required',
            'deskripsi' => 'required',
            'id_kartu' => 'required',
        ]);

        $pemasukan = new Pemasukan();
        $pemasukan->jumlah_pemasukan = $request->jumlah_pemasukan;
        $pemasukan->deskripsi = $request->deskripsi;
        $pemasukan->id_kartu = $request->id_kartu;

        $kartu = Kartu::find($request->id_kartu);
        $kartu->total += $request->jumlah_pemasukan;
        $kartu->save();

        $pemasukan->save();
        return redirect()->route('pemasukan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemasukan = Pemasukan::find($id);
        return view('pemasukan.show', compact('pemasukan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
