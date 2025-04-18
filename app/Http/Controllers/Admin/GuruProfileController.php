<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TeacherImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GuruProfileController extends Controller
{
    public function index()
    {
        return view('admin.guru.index');
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function edit($id)
    {
        return view('admin.guru.edit', ['guruId' => $id]);
    }

    public function importForm()
    {
        return view('admin.guru.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new TeacherImport, $request->file('file'));

            return redirect()->route('admin.guru.index')
                ->with('message', 'Data guru berhasil diimport!');
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
        $path = public_path('templates/template_import_guru.xlsx');
        return response()->download($path);
    }
}
