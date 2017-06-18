<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DocsController extends Controller
{
    /**
     * Index page of the documentation
     */
    public function index()
    {
        return view('docs/index');
    }
}
