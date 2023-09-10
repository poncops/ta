<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RekeningRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'bank_name' => ['required', 'max:255'],
                    'acc_number' => ['required', 'max:255', 'unique:rekenings'],
                    'name' => ['required', 'max:255'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'bank_name' => ['required', 'max:255'],
                    'acc_number' => ['required', 'max:255'],
                    'name' => ['required', 'max:255'],
                ];
            }
            default: break;
        }
    }
}
