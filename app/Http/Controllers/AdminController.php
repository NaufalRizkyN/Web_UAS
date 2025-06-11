<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function pages()
    {
        return view('admin.pages');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}