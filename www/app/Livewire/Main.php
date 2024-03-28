<?php

namespace App\Livewire;


use Illuminate\Contracts\View\View;
use Livewire\Component;

class Main extends Component
{
    use addToCartTrait, addToFavoriteTrait, addToLikeProductTrait;

    /**
     * @var int
     */
    public int $product_id;

    /**
     * @param int $product_id
     * @return void
     */
    public function mount(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.main', ['product_id' => $this->product_id]);
    }
}
