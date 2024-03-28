<?php

namespace App\Http\Controllers;

use App\Actions\ActionMainClass;
use App\Models\Language;
use App\Models\Slider;
use go280286sai\search_json\Models\Index_search;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $lang = Language::getStatus()->id;

        if (Cache::has('sliders')) {
            $sliders = Cache::get('sliders');
        } else {
            $sliders = Slider::all();
            Cache::put('sliders', $sliders);
        }

        $products = ActionMainClass::get_hits(6);

        return view('main.index', compact(['sliders', 'products', 'lang']));
    }

    /**
     * @throws ValidationException
     */
    public function search(Request $request): View
    {
        $validated = $this->validate($request, [
            'text' => ['required', 'string'],
        ]);
        $search = Index_search::search_text($validated['text']);
        $lang = Language::getStatus()->id;

        return view('main.search', ['search' => $search, 'lang' => $lang]);
    }
}
