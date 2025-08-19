<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
        $id = $this->route('client')?->id;

        return [
            'name'            => ['required','string','max:160'],
            'email'           => ['nullable','email','max:255', Rule::unique('clients','email')->ignore($id)],
            'phone'           => ['nullable','string','max:30'],
            'document_number' => ['nullable','string','max:50', Rule::unique('clients','document_number')->ignore($id)],
            'address'         => ['nullable','string','max:255'],
            'city'            => ['nullable','string','max:120'],
            'status'          => ['required','in:active,inactive'],
            'notes'           => ['nullable','string'],
        ];
    }
}
