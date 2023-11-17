<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaddleCourtRateRequest extends FormRequest
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
            'paddle_court_id'=>'required|exists:paddle_courts,id',
            'rate'=>'required|min:1|max:5',
            'text'=>'required|string',
        ];
    }
}
