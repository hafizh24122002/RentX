<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Property;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index() {
        return view('index', [
            'title' => 'Home',
            'properties' => Property::orderBy("rating",'desc')->orderBy("total_reviewer",'desc')->take(10)->get()
        ]);
    }

    public function search() {
        if (request('sort') == 'recommend') {
            $property = Property::orderBy('rating', 'desc')->orderBy('total_reviewer','desc');
        } else if (request('sort') == 'highest-price') {
            $property = Property::orderBy('price', 'desc');
        } else if (request('sort') == 'lowest-price') {
            $property = Property::orderBy('price', 'asc');
        } else {
            $property = Property::latest();
        }
        return view('search', [
            'title' => 'Cari',
            'properties' => $property->filter(request(['search', 'type', 'for', 'city']))->paginate(10)->withQueryString()
        ]);
    }

    public function show(Property $property) {
        return view('property', [
            'title' => 'Detail Properti',
            'property' => $property,
            'properties' => Property::orderBy("rating",'desc')->orderBy("total_reviewer",'desc')->take(10)->get(),
            'reviews' => Review::where('property_id', $property->id)->orderBy('rating', 'desc')->get(),
        ]);
    }

}
