<?php

namespace App\Livewire\Admin\Siswa;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SiswaProfile;
use App\Models\User;

class SiswaList extends Component
{
    use WithPagination;

    public $search = '';
    protected $queryString = ['search' => ['except' => '']];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        // Temukan profil siswa berdasarkan ID
        $siswaProfile = SiswaProfile::findOrFail($id);

        // Hapus user yang terkait dengan profil siswa
        $user = $siswaProfile->user; // Ambil user yang terkait dengan siswa

        // Mulai transaksi agar penghapusan dilakukan bersamaan
        \DB::beginTransaction();
        try {
            // Hapus profil siswa
            $siswaProfile->delete();

            // Hapus user yang terkait
            if ($user) {
                $user->delete();
            }

            // Commit transaksi jika kedua data dihapus dengan sukses
            \DB::commit();

            // Tampilkan pesan sukses
            session()->flash('message', 'Siswa dan akun pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            \DB::rollBack();

            // Tampilkan pesan error
            session()->flash('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function render()
    {
        $query = SiswaProfile::where(function($query) {
            $query->where('nisn', 'like', '%' . $this->search . '%')
                ->orWhere('nama_lengkap', 'like', '%' . $this->search . '%');
        });

        // Eager load 'user' dan 'kelas' untuk menghindari N+1 problem
        $siswa = $query->with(['user', 'kelas'])->paginate(10);

        return view('livewire.admin.siswa.siswa-list', [
            'siswas' => $siswa
        ]);
    }

}
