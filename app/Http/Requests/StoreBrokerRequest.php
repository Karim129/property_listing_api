<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrokerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [$this->isPostRequest(), 'unique:users', 'max:255', $this->id],
            'address' => [$this->isPostRequest(), 'max:255'],
            'city' => [$this->isPostRequest()],
            'zip_code' => [$this->isPostRequest()],
            'phone_number' => [$this->isPostRequest(), 'numeric', 'digits:10'],
            'logo_path' => [$this->isPostRequest()],
        ];
    }

    private function isPostRequest(): string
    {
        return request()->isMethod('post') ? 'required' : 'sometimes';
    }
}
