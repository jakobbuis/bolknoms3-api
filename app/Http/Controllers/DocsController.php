<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class DocsController extends Controller
{
    /**
     * Render a page of the API documentation
     */
    public function page($slug)
    {
        $path = "docs/pages/{$slug}";
        if (!View::exists($path)) {
            return response()->view('docs/404', [], 404);
        }

        return view($path);
    }
}
