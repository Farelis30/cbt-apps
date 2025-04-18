<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        return view('admin.nilai.index');
    }

    public function detail($id)
    {
        $nilai = Nilai::with(['siswa', 'ujian'])->findOrFail($id);
        return view('admin.nilai.detail', ['nilaiId' => $id, 'nilai' => $nilai]);
    }

    public function jawaban($nilaiId)
    {
        $nilai = Nilai::with(['siswa', 'ujian'])->findOrFail($nilaiId);
        return view('admin.nilai.jawaban', ['nilaiId' => $nilaiId, 'nilai' => $nilai]);
    }
}
