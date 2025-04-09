<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuruProfileController extends Controller
{
    public function index()
    {
        return view('admin.guru.index');
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function edit($id)
    {
        return view('admin.guru.edit', ['guruId' => $id]);
    }
}
