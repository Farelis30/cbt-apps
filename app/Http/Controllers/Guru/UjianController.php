<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Imports\SoalImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function importForm()
    {
        return view('admin.guru.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'ujian_id' => 'required|exists:ujians,id',
        ]);

        try {
            Excel::import(new SoalImport($request->ujian_id), $request->file('file'));

            return redirect()->route('guru.ujian.soal', $request->ujian_id)
                ->with('message', 'Soal berhasil diimport!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];

            foreach ($failures as $failure) {
                $errors[] = 'Baris ' . $failure->row() . ': ' . implode(' ', $failure->errors());
            }

            return redirect()->back()->with('error', $errors);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $path = public_path('templates/template_import_soal.xlsx');
        return response()->download($path);
    }
}
