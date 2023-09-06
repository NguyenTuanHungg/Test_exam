<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $exams = Topic::paginate(10);
        return view('user.home', compact('exams'));
    }
}
