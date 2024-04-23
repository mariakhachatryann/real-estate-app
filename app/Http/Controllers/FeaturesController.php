<?php

namespace App\Http\Controllers;

use App\Models\Feature;

class FeaturesController extends Controller
{
    public function index()
    {
        return Feature::all();
    }
}
