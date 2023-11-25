<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title_1' => 'required|string',
            'content_1' => 'nullable|string',
            'exerpt_1' => 'nullable|string',
            'keywords_1' => 'nullable|string',
            'description_1' => 'nullable|string',
            'product_id' => 'nullable|numeric',
            'title_2' => 'required|string',
            'content_2' => 'nullable|string',
            'exerpt_2' => 'nullable|string',
            'keywords_2' => 'nullable|string',
            'description_2' => 'nullable|string',
            'title_3' => 'required|string',
            'content_3' => 'nullable|string',
            'exerpt_3' => 'nullable|string',
            'keywords_3' => 'nullable|string',
            'description_3' => 'nullable|string',
            'category' => 'required|numeric',
            'new_price' => 'required|numeric',
            'amount' => 'required|numeric',
            'img' => 'nullable|image',
        ];
    }
}
