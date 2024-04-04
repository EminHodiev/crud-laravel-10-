<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $all_news =News::all();
        return view('index', compact('all_news'));
    }
}
