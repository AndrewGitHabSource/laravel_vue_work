<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:200',
            'last_name' => 'required',
            'email' => 'required|unique:resumes',
            'phone' => 'required',
            'avatar' => 'required',
            'about' => 'required',
            'info' => 'required',
            'languages' => 'required',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(json_decode($this->form, true, 512, JSON_THROW_ON_ERROR));
    }
}
