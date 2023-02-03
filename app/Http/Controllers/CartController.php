<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::with('user', 'obat')->get();
        return view('cart.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::all();
        $obat = Obat::all();
        return view('cart.create', compact('obat', 'user'));
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
            'id_obat' => 'required',
            'id_user' => 'required',
            'jumlah' => 'required',
        ]);

        $cart = new cart();
        $cart->id_obat = $request->id_obat;
        $cart->id_user = $request->id_user;
        $cart->jumlah = $request->jumlah;
        $cart->total_harga = ($cart->obat->harga * $cart->jumlah);
        $cart->save();
        return redirect()->route('cart.index')
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
        $cart = cart::findOrFail($id);
        return view('cart', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cart = cart::findOrFail($id);
        $obat = Obat::all();
        return view('cart', compact('cart','obat'));

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
            'id_obat' => 'required',
            'id_user' => 'required',
            'jumlah' => 'required',
        ]);
        $cart = cart::findOrFail($id);
        $cart->id_user = $request->id_user;
        $cart->id_obat = $request->id_obat;
        $cart->jumlah = $request->jumlah;
        $cart->save();
        return redirect()->route('cart')
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
        $cart = cart::findOrFail($id);
        $cart->delete();
        return redirect()->route('cart')
            ->with('success', 'Data berhasil dihapus!');
    }

}
