<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CartModal extends Component
{
    /**
     * @var array
     */
    public array $carts = [];
    /**
     * @var int
     */
    #[Validate('required')]
    public int $new_qty = 0;
    /**
     * @var int
     */
    public int $ide;

    /**
     * @return void
     */
    public function mount(): void
    {
        if (Session::has('cart')) {
            $this->carts = Session::get('cart');

            Product::translate();
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function save($id): void
    {
        $this->validate(
            ['new_qty' => 'numeric|nullable|gt:0'],
            ['new_qty.gt' => 'The quantity must be greater than 0.']
        );

        Product::updateCart($id, $this->new_qty);

        $this->refresh();
    }

    /**
     * @return void
     */
    #[On('cart_reload')]
    public function refresh(): void
    {
        $this->js('window.location.reload();');
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        Product::clear();

        $this->redirect('/');
    }

    /**
     * @return void
     */
    public function continue(): void
    {
        $this->redirect('/');
    }

    /**
     * @return void
     */
    public function store(): void
    {
        $this->redirect('/cart/store');
    }

    /**
     * @return void
     */
    public function delivery(): void
    {
        $this->redirect('/cart/delivery');
    }

    /**
     * @param int $id
     * @param int $qty
     * @return void
     */
    public function update(int $id, int $qty): void
    {
        Product::updateCart($id, $qty);

        $this->refresh();
    }

    /**
     * @param int $id
     * @return void
     */
    public function remove(int $id): void
    {
        Product::removeCart($id);

        $this->refresh();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.cart-modal', ['carts' => $this->carts]);
    }
}
