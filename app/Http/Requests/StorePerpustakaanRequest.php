<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerpustakaanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'max:100'],
            'penulis' => ['required', 'max:100'],
            'gambar' => ['required'],
            'price' => ['required', 'numeric', 'min:1'],
            'jumlah' => ['required', 'numeric', 'min:0'],
        ];
    }
}
