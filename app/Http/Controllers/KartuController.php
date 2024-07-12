<?php

namespace App\Http\Controllers;

use App\Models\Kartu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KartuController extends Controller
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
        $kartu = Kartu::latest()->get();
        confirmDelete('Hapus Kartu!', 'Apakah Anda Yakin?');
        return view('user.kartu.index', compact('kartu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kartu = Kartu::all();
        return view('user.kartu.create', compact('kartu'));
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
            'total' => 'nullable|integer',
        ]);

        // if (!$request->filled('total')) {
        //     $input['total'] = 0; // Atur nilai default jika tidak diisi
        // }

        // Kartu::create($input);

        $kartu = new Kartu();
        $kartu->nama_kartu = $request->nama_kartu;
        $kartu->no_kartu = $request->no_kartu;
        $kartu->total = $request->total;
        $kartu->save();
        Alert::success('Success', 'Kartu Berhasil Dibuat.')->autoClose(1500);

        return redirect()->route('dompet.index');
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
        return view('user.kartu.edit', compact('kartu'));
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
            'total' => 'nullable|integer',
        ]);

        $kartu = Kartu::findOrFail($id);
        $kartu->nama_kartu = $request->nama_kartu;
        $kartu->no_kartu = $request->no_kartu;
        $kartu->save();
        Alert::success('Success', 'Kartu Berhasil Diedit.')->autoClose(1500);

        return redirect()->route('dompet.index');
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
        Alert::success('Terhapus!', 'Kartu Berhasil Dihapus')->autoClose(1500);
        return redirect()->route('dompet.index');
    }
}
