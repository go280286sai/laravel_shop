<?php

namespace App\Livewire;

use App\Livewire\addToCartTrait;
use App\Models\Wishlist;
use Livewire\Component;

class WishlistModel extends Component
{
    use addToCartTrait;
    public string $product_id;
    public function mount(int $product_id)
    {
        $this->product_id = $product_id;
    }

    public function removeFromFavorite(int $id)
    {
        Wishlist::remove($id);
        $this->dispatch('add_favorite');
        $this->dispatch('cart_reload');
    }
    public function render()
    {
        return view('livewire.wishlist-model', ['product_id' => $this->product_id]);
    }
}
