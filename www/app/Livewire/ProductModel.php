<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductModel extends Component
{
    use addToCartTrait, addToFavoriteTrait, addToLikeProductTrait;

    /**
     * @var int
     */
    public int $id;

    /**
     * @param int $id
     * @return void
     */
    public function mount(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.product-model');
    }
}
