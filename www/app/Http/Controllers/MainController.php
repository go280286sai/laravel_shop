<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Product;
use App\Models\Slider;
use go280286sai\search_json\Models\Index_search;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;



class MainController extends Controller
{
    /**
     * Get main page
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
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
        $products = $this->get_hits(6);

        return view('main.index', compact(['sliders', 'products', 'lang']));
    }

    /**
     * Get a set of records by hits
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function get_hits(int $limit): object
    {
        if (Cache::has('hit')) {
            return Cache::get('hit');
        } else {
            $hit = Product::where('hit', '>', 0)
                ->orderBy('hit', 'DESC')
                ->limit($limit)
                ->get();
            Cache::put('hit', $hit);
        }

        return $hit;
    }

    public function search(Request $request): \Illuminate\Contracts\View\View
    {
        $request->validate([
            'text'=>'required|string',
        ]);
        $search = Index_search::search_text($request->input('text'));
        $lang = Language::getStatus()->id;

        return view('main.search', ['search' => $search, 'lang' => $lang]);
    }
}
