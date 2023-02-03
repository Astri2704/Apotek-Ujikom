<?php

namespace App\Http\Controllers;

use App\Models\User;

class TotalController extends Controller
{
    public function index()
    {
        $user = User::all();
        $total = $user->Count();
        $total_obat = DB::table('obats')
            ->sum('stok');

        $total_obat = $obat->Count();

        return view('layouts.components.beranda', compact('total'));
    }

}
