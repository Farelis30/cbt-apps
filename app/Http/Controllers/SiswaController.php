<?php

namespace App\Http\Controllers;

use App\Models\JawabanSiswa;
use App\Models\Nilai;
use App\Models\SiswaProfile;
use App\Models\Soal;
use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        // ambil data siswaprofile dari user yg login
        $user = Auth::user();
        $siswaProfile = SiswaProfile::where('user_id', $user->id)->first();
        $ujians = Ujian::where('kelas_id', $siswaProfile->kelas_id)->get();
        return view('livewire.siswa.home',
            [
                'ujians' => $ujians,
            ]
        );
    }

    public function jadwal()
    {
        $user = Auth::user();
        $siswaProfile = SiswaProfile::where('user_id', $user->id)->first();
        $ujians = Ujian::where('kelas_id', $siswaProfile->kelas_id)
                    ->with(['guru', 'kelas', 'mataPelajaran'])
                    ->get();

        return view('livewire.siswa.schedule', [
            'ujians' => $ujians
        ]);
    }

    public function detailUjian($id)
    {
        $ujian = Ujian::with(['guru', 'kelas', 'mataPelajaran'])->findOrFail($id);

        // Cek apakah siswa sudah mengerjakan ujian ini
        $siswaProfile = SiswaProfile::where('user_id', Auth::id())->first();
        $nilai = Nilai::where('siswa_id', $siswaProfile->id)
                ->where('ujian_id', $id)
                ->first();

        if ($nilai) {
            return redirect()->route('siswa.ujian-selesai')->with('message', 'Anda sudah mengerjakan ujian ini');
        }

        return view('livewire.siswa.exam-detail',['ujianId' => $id, 'ujian' => $ujian]);
    }

    public function mulaiUjian($id)
    {
        $ujian = Ujian::findOrFail($id);
        $siswaProfile = SiswaProfile::where('user_id', Auth::id())->first();

        // Cek apakah waktu ujian valid
        $now = Carbon::now();
        if ($now->lt(Carbon::parse($ujian->waktu_mulai)) || $now->gt(Carbon::parse($ujian->waktu_selesai))) {
            return redirect()->route('siswa.home')->with('error', 'Ujian belum dimulai atau sudah berakhir');
        }

        // Cek apakah siswa sudah mengerjakan ujian ini
        $nilai = Nilai::where('siswa_id', $siswaProfile->id)
                ->where('ujian_id', $id)
                ->first();

        if ($nilai) {
            return redirect()->route('siswa.ujian-selesai')->with('message', 'Anda sudah mengerjakan ujian ini');
        }

        // Ambil soal-soal ujian
        $soals = Soal::where('ujian_id', $id)->get()->shuffle();
        if ($soals->isEmpty()) {
            return redirect()->route('siswa.home')->with('error', 'Soal untuk ujian ini belum tersedia.');
        }
        $currentSoal = $soals->first();

        // Simpan data ujian ke session
        session([
            'ujian_id' => $id,
            'soals' => $soals,
            'current_index' => 0,
            'start_time' => $now->timestamp,
            'end_time' => $now->addMinutes($ujian->duration)->timestamp,
            'jawaban' => []
        ]);

        return redirect()->route('siswa.ujian', ['soalId' => $currentSoal->id]);
    }

    public function ujian(Request $request, $soalId = null)
    {
        // Cek session ujian
        if (!session()->has('ujian_id')) {
            return redirect()->route('siswa.home')->with('error', 'Sesi ujian tidak valid');
        }

        $ujianId = session('ujian_id');
        $ujian = Ujian::findOrFail($ujianId);
        $soals = session('soals');
        $currentIndex = session('current_index', 0);

        // Cek waktu ujian
        $now = Carbon::now()->timestamp;
        $endTime = session('end_time');

        if ($now > $endTime) {
            return $this->selesaiUjian();
        }

        // Jika soalId tidak ada, ambil dari index
        if (!$soalId) {
            $soal = $soals[$currentIndex];
        } else {
            // Cari soal berdasarkan ID
            $soal = Soal::findOrFail($soalId);
            // Update current index
            foreach ($soals as $index => $s) {
                if ($s->id == $soalId) {
                    $currentIndex = $index;
                    session(['current_index' => $currentIndex]);
                    break;
                }
            }
        }

        // Ambil jawaban siswa jika sudah ada
        $jawaban = session('jawaban', []);
        $jawabanSoal = isset($jawaban[$soal->id]) ? $jawaban[$soal->id] : null;

        $sisaWaktu = $endTime - $now;
        $menit = floor($sisaWaktu / 60);
        $detik = $sisaWaktu % 60;

        return view('livewire.siswa.exam', [
            'ujian' => $ujian,
            'soal' => $soal,
            'totalSoal' => count($soals),
            'currentIndex' => $currentIndex + 1,
            'jawabanSoal' => $jawabanSoal,
            'menit' => $menit,
            'detik' => $detik,
            'soals' => $soals,
            'jawaban' => $jawaban
        ]);
    }

    public function simpanJawaban(Request $request)
    {
        $soalId = $request->input('soal_id');
        $jawaban = $request->input('jawaban');

        // Simpan jawaban ke session
        $jawabanSession = session('jawaban', []);
        $jawabanSession[$soalId] = $jawaban;
        session(['jawaban' => $jawabanSession]);

        // Next atau prev
        $action = $request->input('action', 'next');
        $soals = session('soals');
        $currentIndex = session('current_index', 0);

        if ($action == 'next' && $currentIndex < count($soals) - 1) {
            $currentIndex++;
        } else if ($action == 'prev' && $currentIndex > 0) {
            $currentIndex--;
        } else if ($action == 'finish') {
            return $this->selesaiUjian();
        } else if ($action == 'goto') {
            $goToIndex = $request->input('goto_index');
            if ($goToIndex >= 0 && $goToIndex < count($soals)) {
                $currentIndex = $goToIndex;
            }
        }

        session(['current_index' => $currentIndex]);
        $nextSoal = $soals[$currentIndex];

        return redirect()->route('siswa.ujian', ['soalId' => $nextSoal->id]);
    }

    public function selesaiUjian()
    {
        $ujianId = session('ujian_id');
        $jawaban = session('jawaban', []);
        $siswaProfile = SiswaProfile::where('user_id', Auth::id())->first();

        if (!$ujianId || !$siswaProfile) {
            return redirect()->route('siswa.home')->with('error', 'Sesi ujian tidak valid');
        }

        // Proses jawaban
        $totalSkor = 0;
        $totalBenar = 0;

        foreach ($jawaban as $soalId => $jawabanSiswa) {
            $soal = Soal::find($soalId);
            if ($soal) {
                $isCorrect = $jawabanSiswa === $soal->jawaban_benar;
                $skor = $isCorrect ? $soal->bobot : 0;
                $totalSkor += $skor;

                if ($isCorrect) {
                    $totalBenar++;
                }

                // Simpan jawaban siswa
                JawabanSiswa::create([
                    'siswa_id' => $siswaProfile->id,
                    'ujian_id' => $ujianId,
                    'soal_id' => $soalId,
                    'jawaban' => $jawabanSiswa,
                    'is_correct' => $isCorrect,
                    'skor' => $skor
                ]);
            }
        }

        // Simpan nilai
        $ujian = Ujian::find($ujianId);
        $nilai = new Nilai();
        $nilai->siswa_id = $siswaProfile->id;
        $nilai->ujian_id = $ujianId;
        $nilai->nilai = ($totalSkor/$ujian->jumlah_soal)*100;
        $nilai->tanggal_ujian = Carbon::now()->toDateString();
        $nilai->save();

        // Hapus session ujian
        session()->forget(['ujian_id', 'soals', 'current_index', 'start_time', 'end_time', 'jawaban']);


        return view('livewire.siswa.exam-finished', [
            'nilai' => $nilai,
            'ujian' => $ujian,
            'totalBenar' => $totalBenar,
            'totalSoal' => $ujian->jumlah_soal
        ]);
    }

    public function ujianSelesai()
    {
        $siswaProfile = SiswaProfile::where('user_id', Auth::id())->first();
        $nilai = Nilai::with('ujian')
                ->where('siswa_id', $siswaProfile->id)
                ->orderBy('created_at', 'desc')
                ->first();

        if (!$nilai) {
            return redirect()->route('siswa.home');
        }

        return view('livewire.siswa.exam-finished');
    }
}
