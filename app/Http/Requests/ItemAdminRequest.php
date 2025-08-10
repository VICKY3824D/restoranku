<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class ItemAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'is_active' => ['required','boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Deskripsi harus berupa string.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
            'category_id.required' => 'Kategori wajib diisi.',
            'category_id.exists' => 'Kategori tidak valid.',
            'img.image' => 'File harus berupa gambar.',
            'img.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'img.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'is_active.required' => 'Status wajib diisi.',
            'is_active.boolean' => 'Status harus berupa boolean.',
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        throw new HttpResponseException(
//            redirect()
//                ->back()
//                ->withErrors($validator)
//                ->withInput()
//        );
//    }

}
