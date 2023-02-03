<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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
        $total_cart = Cart::all()->count();
        return view('cart', compact('cart', 'total_cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // $user = User::all();
        $user = User::where('role', 'user')->get();
        $obat = Obat::all();
        return view('single_shop', compact('obat', 'user'));
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

        $cart = new Cart();
        $cart->id_obat = $request->id_obat;
        $cart->id_user = $request->id_user;
        $cart->jumlah = $request->jumlah;
        $cart->total_harga = ($cart->obat->harga * $cart->jumlah);
        $cart->save();
        return redirect('cart_user')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $cart = Cart::all();
        $cart->save();
        return redirect('cart_user')
            ->with('success', 'Data berhasil di update!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cart = new Cart();
        $cart->jumlah = $request->jumlah;
        $cart->save();
        return redirect('cart_user')
            ->with('success', 'Data berhasil dibuat!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect('cart_user')
            ->with('success', 'Data berhasil dihapus!');
    }
    // public function destroyAll()
    // {
    //     DB::table('carts')->delete();
    //     return redirect()->route('cart')
    //         ->with('success', 'Data berhasil dihapus!');
    // }
}
