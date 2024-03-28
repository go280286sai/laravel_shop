<?php

namespace App\Livewire;

use App\Models\Product;

trait addToCartTrait
{
    /**
     * @param int $id
     * @param int $qty
     * @return void
     */
    public function addToCart(int $id, int $qty = 1): void
    {
        Product::add_to_cart($id, $qty);
        $this->dispatch('cart_reload');
    }
}
