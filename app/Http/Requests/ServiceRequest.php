<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'icon' => 'required|max:128|regex:/(^[A-Za-z0-9-]+$)+/',
            'text' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Поле обязательно к заполнению.',
            'max' => 'Длина должна быть не более :max символов.',
            'filter' => 'Поле может содержать только латинские символы, цифры, пробел, тире и запятые.'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation() {
        $this->merge([
            'icon' => strtolower(trim($this->icon)),
            'text' => strip_tags($this->text),
        ]);
    }
}
