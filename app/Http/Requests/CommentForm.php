<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth("web")->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "text" => ["required", "string", "min:5"],
            "user_id" => ["required", "exists:users,id"]
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
           "user_id" => auth("web")->id()
        ]);
    }
}
