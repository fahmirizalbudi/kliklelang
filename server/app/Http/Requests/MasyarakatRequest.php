<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MasyarakatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $masyarakat = $this->route('masyarakat');

        return [
            'nama_lengkap' => 'required',
            'username' => [
                'required',
                Rule::unique('tb_masyarakat', 'username')->ignore($masyarakat),
                Rule::unique('tb_petugas', 'username')->ignore($masyarakat, 'id_petugas'),
            ],
            'password' => $masyarakat ? 'nullable|confirmed|min:6' : 'required|confirmed|min:6',
            'telp' => 'required',
            'alamat' => 'required',
            'nik' => [
                'required',
                'min:16',
                'max:16',
                Rule::unique('tb_masyarakat', 'nik')->ignore($masyarakat),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'telp.required' => 'Telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK sudah digunakan, silakan pilih yang lain.',
            'nik.min' => 'NIK harus berisi tepat 16 digit.',
            'nik.max' => 'NIK harus berisi tepat 16 digit.',
        ];
    }
}
