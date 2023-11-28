<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class HeadModel extends Component
{
    public int $wishlists = 0;
    public int $carts = 0;


    public function mount()
    {
        if (Session::has('wishlist')) {
            $this->wishlists = count(Session::get('wishlist'));
        }
        if (Session::has('cart')) {
            $this->carts = count(Session::get('cart'));
        }
    }

    #[On('add_favorite')]
    public function updateWishlist(): void
    {
        $wishlists = $this->wishlists;
        if (Session::has('wishlist')) {
            $this->wishlists = count(Session::get('wishlist'));
        }
        if ($this->wishlists == $wishlists) {
            $this->js("alert('Товар уже добавлен в избранное')");
        }
        $this->js("
        let id = document.getElementById('favorite-count');
        id.innerHTML = $this->wishlists;");
    }

    public function render()
    {
        return view('livewire.head-model');
    }
}
