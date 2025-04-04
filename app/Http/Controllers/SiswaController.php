<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('livewire.siswa.home');
    }

    public function jadwal()
    {
        return view('livewire.siswa.schedule');
    }

    public function detailUjian()
    {
        return view('livewire.siswa.exam-detail');
    }

    public function ujian()
    {
        return view('livewire.siswa.exam');
    }

    public function ujianSelesai()
    {
        return view('livewire.siswa.exam-finished');
    }
}
