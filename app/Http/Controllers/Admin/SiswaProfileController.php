<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiswaProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SiswaProfileController extends Controller
{
    public function index()
    {
        return view('admin.siswa.index');
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function edit($id)
    {
        return view('admin.siswa.edit', ['siswaId' => $id]);
    }
}
