<?php

namespace App\Livewire;

use App\Models\Wishlist;

trait addToFavoriteTrait
{
    /**
     * @param int $id
     * @return void
     */
    public function addToFavorite(int $id): void
    {
        Wishlist::add($id);
        $this->dispatch('add_favorite');
    }
}
