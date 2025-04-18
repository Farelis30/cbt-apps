<?php

namespace App\Http\Controllers;

use App\Imports\SoalImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

            return redirect()->route('admin.ujian.soal', $request->ujian_id)
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
