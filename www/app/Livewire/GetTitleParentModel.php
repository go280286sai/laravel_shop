<?php

namespace App\Livewire;

use App\Models\Language;
use App\Models\Main_description;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GetTitleParentModel extends Component
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @param int $id
     * @return void
     */
    public function mount(int $id): void
    {
        $this->title = Main_description::all()->where('main_id', $id)
            ->where("language_id", Language::getStatus()->id)->first()->title;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.get-title-parent-model', ['parent_title' => $this->title]);
    }
}
