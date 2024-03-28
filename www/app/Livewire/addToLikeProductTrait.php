<?php

namespace App\Livewire;

use App\Models\Product;

trait addToLikeProductTrait
{
    /**
     * @param int $id
     * @return void
     */
    public function addToLike(int $id): void
    {
        Product::add_to_like($id);
        $this->dispatch('cart_reload');
    }
}
