<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAdminUpdateRequest extends FormRequest
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
        $userId = $this->route('user'); // Mendapatkan ID dari route parameter

        return [
            'username' => 'required|string|max:255|unique:users,username,' . $userId,
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $userId,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi',
            'username.string' => 'Username harus berupa teks',
            'username.max' => 'Username maksimal 255 karakter',
            'username.unique' => 'Username sudah digunakan',
            'fullname.required' => 'Nama lengkap wajib diisi',
            'fullname.string' => 'Nama lengkap harus berupa teks',
            'fullname.max' => 'Nama lengkap maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.string' => 'Email harus berupa teks',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'phone.required' => 'Nomor telepon wajib diisi',
            'phone.string' => 'Nomor telepon harus berupa teks',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
            'password.string' => 'Password harus berupa teks',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role_id.required' => 'Role wajib dipilih',
            'role_id.exists' => 'Role yang dipilih tidak valid',
        ];
    }
}
