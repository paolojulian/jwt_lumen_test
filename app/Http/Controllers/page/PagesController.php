<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Page;

class PagesController extends Controller
{
    /**
     * [GET]
     * Creates a page
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|unique:pages|max:100',
            'url' => 'required'
        ]);

        $parent_page_id = isset($validated['parent_page_id'])
            ? $validated['parent_page_id']
            : 0;

        $page = new Page;
        $page->name = $validated['name'];
        $page->url = $validated['url'];
        $page->parent_page_id = $parent_page_id;
        $page->last_updated_by = Auth::user()->id;
        $page->save();

        return $this->successCreateResponse($page->name, $page);
    }

}