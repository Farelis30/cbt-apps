<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('admin.kelas.index');
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function edit($id)
    {
        return view('admin.kelas.edit', ['kelasId' => $id]);
    }
}
