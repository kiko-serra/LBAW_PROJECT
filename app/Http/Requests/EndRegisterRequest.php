<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EndRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'pronouns' => 'string|max:20|regex:/.+\/.+/',
            'location' => 'string|max:36',
            'description' => 'string|max:255'
        ];
    }
}
