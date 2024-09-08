<?php

namespace App\Http\Requests\OrderRequests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'type_id' => ['required','integer'],
            'partnership_id' => ['required','integer'],
            'description' => ['sometimes','nullable','string'],
            'date' => ['required','date'],
            'address' => ['required','string'],
            'amount' => ['required','decimal:0,2'],
            'status' => ['required','string','in:created,assigned,completed'],
        ];
    }
}
