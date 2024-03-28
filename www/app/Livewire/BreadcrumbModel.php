<?php

namespace App\Livewire;

use App\Actions\MapPathClass;
use App\Models\Language;
use App\Models\Product;
use App\Models\Product_description;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BreadcrumbModel extends Component
{
    /**
     * @var string
     */
    public string $id;
    /**
     * @var string
     */
    public string $product_title;
    /**
     * @var string
     */
    public string $product_id;
    /**
     * @var string
     */
    public string $target = '';

    /**
     * @param int $id
     * @param string $target
     * @return void
     */
    public function mount(int $id, string $target = 'category'): void
    {
        $this->product_id = $id;
        $this->target = $target;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        if ($this->target == 'product') {
            $this->product_title = Product_description::where('product_id', $this->id)
                ->where('language_id', Language::getStatus()->id)
                ->get()[0]
                ->title;

            $path = MapPathClass::path_category(Product::find($this->id)->category_id);

            return view('livewire.breadcrumb-model', ['path' => $path]);
        }

        $path = MapPathClass::path_category($this->product_id);

        return view('livewire.breadcrumb-model', ['path' => $path]);
    }
}
