<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:128',
            'position' => 'required|max:160',
            'text' => 'required',
            'images' => 'mimes:gif,jpg,jpeg,png,svg'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation() {
        $this->merge([
            'text' => strip_tags($this->text),
        ]);
    }
}
