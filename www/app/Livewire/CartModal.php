<?php

namespace App\Livewire;

use App\Models\Language;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CartModal extends Component
{
    public array $carts = [];
    #[Validate('required')]
    public int $new_qty=0;
    public int $ide;

    public function mount(): void
    {
        if (Session::has('cart')) {
            $this->carts = Session::get('cart');
            Product::translate();
        }
    }

    public function save($id)
    {
        $this->validate(['new_qty' => 'numeric|nullable|gt:0'], ['new_qty.gt' => 'The quantity must be greater than 0.']);
        Product::updateCart($id, $this->new_qty);
        $this->refresh();
}
    #[On('cart_reload')]
    public function refresh()
    {
        $this->js("window.location.reload();");
    }

    public function clear()
    {
        $this->redirect('/cart/clear');
    }

    public function store()
    {
        $this->redirect("/cart/store");
    }

    public function update(int $id, int $qty)
    {
        Product::updateCart($id, $qty);
        $this->refresh();
    }

    public function remove(int $id)
    {
        Product::removeCart($id);
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.cart-modal', ['carts' => $this->carts]);
    }
}
