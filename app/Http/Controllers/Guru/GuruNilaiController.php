<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class GuruNilaiController extends Controller
{
    public function index()
    {
        return view('guru.nilai.index');
    }

    public function detail($id)
    {
        $nilai = Nilai::with(['siswa', 'ujian'])->findOrFail($id);
        return view('guru.nilai.detail', ['nilaiId' => $id, 'nilai' => $nilai]);
    }

    public function jawaban($nilaiId)
    {
        $nilai = Nilai::with(['siswa', 'ujian'])->findOrFail($nilaiId);
        return view('guru.nilai.jawaban', ['nilaiId' => $nilaiId, 'nilai' => $nilai]);
    }
}
