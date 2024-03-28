<?php

namespace App\Livewire;

use App\Actions\GetParseDataClass;
use App\Models\Resource_product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class GetParseDataModel extends Component
{
    /**
     * @var bool
     */
    public bool $status_download = false;

    /**
     * @return RedirectResponse
     */
    public function clearJsons(): RedirectResponse
    {
        $obj = new GetParseDataClass();
        $obj->clearJsons();
        $this->js('window.location.reload();');
        return redirect()->back()->with('status', 'Данные успешно удалены');
    }

    /**
     * @return void
     */
    public function download(): void
    {
        $obj = new GetParseDataClass();
        $obj->existsFiles();
        $this->clearJsons();
        $this->js('window.location.reload();');
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        if (Storage::files('/uploads/jsons') !== []) {
            $this->status_download = true;
        }
    }

    /**
     * @return RedirectResponse
     */
    public function clearAll(): RedirectResponse
    {
        $obj = new GetParseDataClass();
        $obj->clearAll();
        $this->js('window.location.reload();');
        return redirect()->back()->with('status', 'Данные успешно удалены');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $resources = $resources = Resource_product::all();
        return view('livewire.get-parse-data-model', [
            'resources' => $resources, 'status_download' => $this->status_download
        ]);
    }
}
