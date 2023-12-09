<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class WishlistModel extends Component
{
    use addToCartTrait;

    /**
     * @var string
     */
    public string $product_id;

    /**
     * @param int $product_id
     * @return void
     */
    public function mount(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function removeFromFavorite(int $id): void
    {
        Wishlist::remove($id);

        $this->dispatch('add_favorite');
        $this->dispatch('cart_reload');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.wishlist-model', ['product_id' => $this->product_id]);
    }
}
