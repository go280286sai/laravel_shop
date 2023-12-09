<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdGetRequest;
use App\Models\Language;
use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        if (Session::has('wishlist')) {
            $wishlists = Session::get('wishlist');
        } else {
            $wishlists = [];
        }

        return view('products.wishlist', ['products' => $wishlists, 'lang' => Language::getStatus()->id]);
    }
}
