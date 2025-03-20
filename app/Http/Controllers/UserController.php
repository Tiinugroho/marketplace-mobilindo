<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function customerIndex()
    {
        // Ambil semua user dengan role 'customer'
        $customers = User::where('role', 'client')->get();

        return view('admin.customer.index', compact('customers'));
    }

    public function sellerIndex()
    {
        // Ambil semua user dengan role 'seller'
        $sellers = User::where('role', 'seller')->get();

        return view('admin.seller.index', compact('sellers'));
    }
}
