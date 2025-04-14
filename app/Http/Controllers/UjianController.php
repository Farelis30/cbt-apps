<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        return view('admin.ujian.index');
    }

    public function create()
    {
        return view('admin.ujian.create');
    }

    public function edit($id)
    {
        return view('admin.ujian.edit', ['ujianId' => $id]);
    }

    public function soal($id)
    {
        return view('admin.ujian.soal', ['ujianId' => $id]);
    }

    public function createSoal($id)
    {
        return view('admin.ujian.soal-create', ['ujianId' => $id]);
    }

    public function editSoal($ujianId, $soalId)
    {
        return view('admin.ujian.soal-edit', [
            'ujianId' => $ujianId,
            'soalId' => $soalId
        ]);
    }

    public function nilai()
    {
        return view('admin.ujian.nilai');
    }

    public function detailNilai($ujianId)
    {
        return view('admin.ujian.detail-nilai', ['ujianId' => $ujianId]);
    }
}
