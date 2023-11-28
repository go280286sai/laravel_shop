<?php

namespace App\Livewire;

use App\Models\Language;
use App\Models\Product;
use Exception;
use Livewire\Component;

class ProductModel extends Component
{
    use addToCartTrait, addToFavoriteTrait;

    public int $id;

    public function mount(int $id)
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('livewire.product-model');
    }
}
