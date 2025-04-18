<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\Kelas;
use App\Models\SiswaProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new StudentImport, $request->file('file'));

            return redirect()->route('admin.siswa.index')
                ->with('message', 'Data siswa berhasil diimport!');
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
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header pada template
        $sheet->setCellValue('A1', 'username');
        $sheet->setCellValue('B1', 'email');
        $sheet->setCellValue('C1', 'nisn');
        $sheet->setCellValue('D1', 'nama_lengkap');
        $sheet->setCellValue('E1', 'kelas_id');

        // Tambahkan beberapa baris contoh (opsional)
        $sheet->setCellValue('A2', 'siswa1');
        $sheet->setCellValue('B2', 'siswa1@example.com');
        $sheet->setCellValue('C2', '1234567890');
        $sheet->setCellValue('D2', 'Nama Siswa 1');
        $sheet->setCellValue('E2', '1'); // ID kelas

        // Tambahkan panduan pada baris berikutnya
        $sheet->setCellValue('A4', 'Catatan:');
        $sheet->setCellValue('A5', '1. username: Harus unik dan tidak boleh kosong');
        $sheet->setCellValue('A6', '2. email: Harus valid dan unik');
        $sheet->setCellValue('A7', '3. nisn: Nomor identitas siswa, harus unik');
        $sheet->setCellValue('A8', '4. nama_lengkap: Nama lengkap siswa');
        $sheet->setCellValue('A9', '5. kelas_id: ID kelas dari sistem');

        // Tambahkan daftar kelas yang tersedia
        $sheet->setCellValue('A11', 'Daftar ID Kelas:');

        $kelas = Kelas::all();
        $row = 12;
        foreach ($kelas as $k) {
            $sheet->setCellValue('A' . $row, $k->id . ' = ' . $k->kelas);
            $row++;
        }

        // Simpan file
        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), 'template_siswa_');
        $writer->save($tempFile);

        return response()->download($tempFile, 'template_import_siswa.xlsx')->deleteFileAfterSend(true);
    }
}
