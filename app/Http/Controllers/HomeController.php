<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $exams = Topic::paginate(10);
        $categories = Category::all();
        return view('user.home', compact('exams', 'categories'));
    }
}
