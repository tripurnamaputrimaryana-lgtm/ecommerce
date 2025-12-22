<?php
// app/Http/Requests/UpdateProductRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan membuat request ini.
     */
    public function authorize(): bool
    {
        // Hanya user dengan role 'admin' yang boleh mengupdate produk.
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Aturan validasi untuk data yang dikirim saat update.
     */
    public function rules(): array
    {
        return [
            // category_id opsional, tapi jika dikirim harus valid
            'category_id'    => ['nullable', 'exists:categories,id'],

            // name opsional, tapi jika dikirim harus string max 255
            'name'           => ['nullable', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],

            // price opsional, tapi jika dikirim minimal 1000
            'price'          => ['nullable', 'numeric', 'min:1000'],

            // discount_price opsional, tetap harus < price jika dikirim
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],

            // stock opsional, jika dikirim harus integer >= 0
            'stock'          => ['nullable', 'integer', 'min:0'],

            // weight opsional, jika dikirim minimal 1 gram
            'weight'         => ['nullable', 'integer', 'min:1'],

            'is_active'      => ['nullable', 'boolean'],
            'is_featured'    => ['nullable', 'boolean'],

            // Validasi Array Gambar (opsional)
            'images'         => ['nullable', 'array', 'max:10'],
            'images.*'       => [
                'image',
                'mimes:jpg,png,webp',
                'max:2048',
            ],
        ];
    }

    /**
     * Persiapkan data sebelum validasi dijalankan.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active'   => $this->boolean('is_active'),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }
}
