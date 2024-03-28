<?php

namespace go280286sai\search_json\Http\Controllers;

use go280286sai\search_json\Models\Index_search;
use Illuminate\Http\Request;

class SearchJsonController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function index(Request $request): array
    {
        $request->validate([
            'text' => 'required|string'
        ]);
        $text = htmlspecialchars($request->input('text'));

        return Index_search::search_text($text);
    }
}
