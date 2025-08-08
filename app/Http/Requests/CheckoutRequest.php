<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckoutRequest extends FormRequest
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
        return [
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,qris', // ✅ validasi enum
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Nama lengkap wajib diisi.',
            'fullname.max' => 'Nama lengkap maksimal 255 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'payment_method.required' => 'Pilih metode pembayaran.',
            'payment_method.in' => 'Metode pembayaran tidak valid.', // ✅
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()
                ->route('checkout.')
                ->withErrors($validator)
                ->withInput()
        );
    }
}
