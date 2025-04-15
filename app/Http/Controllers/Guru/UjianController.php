<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        return view('guru.ujian.index');
    }

    public function create()
    {
        return view('guru.ujian.create');
    }

    public function edit($id)
    {
        return view('guru.ujian.edit', ['ujianId' => $id]);
    }

    public function soal($id)
    {
        return view('guru.ujian.soal', ['ujianId' => $id]);
    }

    public function createSoal($id)
    {
        return view('guru.ujian.soal-create', ['ujianId' => $id]);
    }

    public function editSoal($ujianId, $soalId)
    {
        return view('guru.ujian.soal-edit', [
            'ujianId' => $ujianId,
            'soalId' => $soalId
        ]);
    }

    public function nilai()
    {
        return view('guru.ujian.nilai');
    }

    public function detailNilai($ujianId)
    {
        return view('guru.ujian.detail-nilai', ['ujianId' => $ujianId]);
    }
}
