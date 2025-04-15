<?php

namespace App\Livewire\Guru\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\AdminProfile;
use App\Models\GuruProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingForm extends Component
{
    use WithFileUploads;

    public $username, $email, $nama_lengkap, $password, $password_confirmation, $image;
    public $user;
    public $guru;
    public $tempImage; // For previewing the new image before saving

    public function mount()
    {
        $this->user = Auth::user();
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $guru = $this->user->guruProfile;
        $this->guru = $guru;

        $this->nama_lengkap = $guru?->nama_lengkap ?? '-';
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);

        // Store the temporary image for preview
        $this->tempImage = $this->image;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'username' => 'required|string|unique:users,username,' . $this->user->id,
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'nama_lengkap' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'nullable|string|min:6',
            'image' => 'nullable|image|max:1024',
        ]);

        $this->user->update([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->user->password,
        ]);

        $imagePath = null;
        if ($this->image) {
            // Delete old image if exists
            if ($this->user->guruProfile && $this->user->guruProfile->image) {
                Storage::disk('public')->delete($this->user->guruProfile->image);
            }
            $imagePath = $this->image->store('profile_images', 'public');
        }

        if ($this->user->guruProfile) {
            $this->user->guruProfile->update([
                'nama_lengkap' => $this->nama_lengkap,
                'image' => $imagePath ?? $this->user->guruProfile->image,
            ]);
        } else {
            $this->user->guruProfile()->create([
                'nama_lengkap' => $this->nama_lengkap,
                'image' => $imagePath,
            ]);
        }

        // Reset temp image after save
        $this->tempImage = null;

        session()->flash('message', 'Profile berhasil diubah!');
    }

    public function render()
    {
        return view('livewire.guru.setting.setting-form');
    }
}
