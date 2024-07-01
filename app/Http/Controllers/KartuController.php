<?php

namespace App\Http\Controllers;


use App\Models\Kartu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KartuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kartu = Kartu::all();
        confirmDelete('Delete Brand!', 'Are you sure you want to delete?');
        return view('kartu.index', compact('kartu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kartu = Kartu::all();
        return view('kartu.create', compact('kartu'));
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
            'nama_kartu' => 'required',
            'no_kartu' => 'required|unique:kartus',
            'total' => 'required',
        ]);

        $kartu = new Kartu();
        $kartu->nama_kartu = $request->nama_kartu;
        $kartu->no_kartu = $request->no_kartu;
        $kartu->total = $request->total;
        $kartu->save();
        Alert::success('Success', 'Kartu Berhasil Dibuat.');

        return redirect()->route('kartu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kartu  $kartu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kartu  $kartu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kartu = Kartu::findOrFail($id);
        return view('kartu.edit', compact('kartu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kartu  $kartu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kartu' => 'required',
            'no_kartu' => 'required',
            'total' => 'required',
        ]);

        $kartu = Kartu::findOrFail($id);
        $kartu->nama_kartu = $request->nama_kartu;
        $kartu->total = $request->total;
        $kartu->save();
        Alert::success('Success', 'Kartu Berhasil Diedit.');

        return redirect()->route('kartu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kartu  $kartu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kartu = Kartu::findOrFail($id);
        $kartu->delete();
        Alert::success('Terhapus!', 'Data Berhasil Dihapus');
        return redirect()->route('kartu.index');
    }
}
