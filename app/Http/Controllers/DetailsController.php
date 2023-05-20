<?php

namespace App\Http\Controllers;

use App\Color;
use App\PrintingType;
use App\Product;
use App\Size;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id, $slug)
    {
        $product = Product::where('id', $id)->where('slug', $slug)->first();
        $colors = Color::all();
        $sizes = Size::all();
        $printings = PrintingType::all();

        return view('pages.details', compact('product', 'colors', 'sizes', 'printings'));
    }
}
