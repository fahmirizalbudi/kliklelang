<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetugasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('petugas')->user()->level->level === 'administrator';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $petugas = $this->route('petugas');

        return [
            'nama_petugas' => 'required',
            'username' => [
                'required',
                Rule::unique('tb_petugas', 'username')->ignore($petugas),
                Rule::unique('tb_masyarakat', 'username')->ignore($petugas, 'id_user'),
            ],
            'password' => $petugas ? 'nullable|confirmed|min:6' : 'required|confirmed|min:6',
            'id_level' => [
                'required',
                Rule::exists('tb_level', 'id_level'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_petugas.required' => 'Nama petugas wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'id_level.required' => 'Level wajib diisi.',
            'id_level.exists' => 'Level tidak valid atau tidak terdaftar.',
        ];
    }
}
