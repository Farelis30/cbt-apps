<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingProfileGuruController extends Controller
{
    public function index()
    {
        return view('guru.setting.index');
    }
}
