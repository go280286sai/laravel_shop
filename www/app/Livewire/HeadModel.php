<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class HeadModel extends Component
{
    /**
     * @var int
     */
    public int $wishlists = 0;
    /**
     * @var int
     */
    public int $carts = 0;

    /**
     * @return void
     */
    public function mount(): void
    {
        if (Session::has('wishlist')) {
            $this->wishlists = count(Session::get('wishlist'));
        }
        if (Session::has('cart')) {
            $this->carts = count(Session::get('cart'));
        }
    }

    /**
     * @return void
     */
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
        id.innerHTML = $this->wishlists;
        ");
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.head-model');
    }
}
