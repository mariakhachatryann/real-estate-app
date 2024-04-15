<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Feature;
class ViewsController extends Controller
{
    public function submitView()
    {
        $features = Feature::all();
        return view('submitProperty', compact('features'));
    }

    public function loginReg()
    {
        return view('loginReg');
    }
}
