<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pembeli;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan semua data dari model Transaksi
        $transaksi = Transaksi::all();
        return view('transaksi', compact('transaksi'));
    }
    // public function transaksi()
    // {
    //     //menampilkan semua data dari model Transaksi
    //     $transaksi = Transaksi::all();
    //     return view('transaksi', compact('transaksi'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pembeli = Pembeli::all();
        $cart = Cart::all();
        return view('checkout', compact('pembeli', 'cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'id_pembeli' => 'required',
            'id_cart' => 'required',
            'tanggal_transaksi' => 'required',
        ]);

        $transaksi = new Transaksi();
        $transaksi->id_pembeli = $request->id_pembeli;
        $transaksi->id_cart = $request->id_cart;
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->save();
        return redirect('transaksi')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi
        $validated = $request->validate([
            'id_pembeli' => 'required',
            'id_cart' => 'required',
            'tanggal_transaksi' => 'required',
        ]);
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->id_pembeli = $request->id_pembeli;
        $transaksi->id_cart = $request->id_cart;
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->save();
        return redirect()->route('transaksi.index')
            ->with('success', 'Data berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
