<?php

namespace App\Http\Controllers;

use App\Services\UmkmSearchService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected UmkmSearchService $umkmSearch)
    {
    }

    public function index(Request $request)
    {
        return view('home', [
            'categories' => $this->umkmSearch->categories(),
            'featured' => $this->umkmSearch->featured(),
            'latest' => $this->umkmSearch->latest(),
        ]);
    }
}
