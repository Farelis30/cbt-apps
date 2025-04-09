<?php

namespace App\Livewire\Admin\Guru;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuruProfile;
use App\Models\User;

class GuruList extends Component
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
        // Temukan profil guru berdasarkan ID
        $guruProfile = GuruProfile::findOrFail($id);

        // Hapus guru yang terkait dengan profil siswa
        $user = $guruProfile->user; // Ambil user yang terkait dengan guru

        // Mulai transaksi agar penghapusan dilakukan bersamaan
        \DB::beginTransaction();
        try {
            // Hapus profil guru
            $guruProfile->delete();

            // Hapus user yang terkait
            if ($user) {
                $user->delete();
            }

            // Commit transaksi jika kedua data dihapus dengan sukses
            \DB::commit();

            // Tampilkan pesan sukses
            session()->flash('message', 'Guru dan akun pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            \DB::rollBack();

            // Tampilkan pesan error
            session()->flash('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function render()
    {
        $query = GuruProfile::where(function($query) {
            $query->where('nama_lengkap', 'like', '%' . $this->search . '%');
        });

        // Eager load 'user' dan 'kelas' untuk menghindari N+1 problem
        $guru = $query->with(['user', 'kelas'])->paginate(10);

        return view('livewire.admin.guru.guru-list', [
            'gurus' => $guru
        ]);
    }
}
