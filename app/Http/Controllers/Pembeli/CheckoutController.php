<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($obat);
        // $obat = Obat::where('slug', $obat)->first();
        // $obat = Obat::all();
        // $jumlah = $request->jumlah;
        $cart = Cart::all();
        $pembeli = Pembeli::all();
        // $pembeli = Pembeli::all();
        return view('checkout', compact('cart', 'pembeli'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $user = User::where('role', 'user')->get();
        // $obat = Obat::all();
        // return view('cart', compact('obat', 'user'));
        $cart = Cart::all();
        $pembeli = Pembeli::all();
        return view('checkout', compact('cart', 'pembeli'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            // $checkout = new Transaksi;
            // $obat = Obat::all();
            // $jumlah = $request->jumlah;
            // $pembeli = Pembeli::all();
            $cart = Cart::all();
            $pembeli = Pembeli::all();
            return view('checkout', compact('cart', 'pembeli'));

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $cart = Cart::all();
        return view('checkout', compec('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        return redirect('cart_user')
            ->with('success', 'Data berhasil dihapus!');
    }

}
