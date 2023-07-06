<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StolenAvtoRequest extends FormRequest
{
    
    protected $redirectRoute = 'add-to-stolen-avto.create';

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

            'name' =>   'required|string|max:50',
            'number' => 'required|unique:car_stoled_base|string|max:15',
            'color' =>  'required|string|max:15',
            'vin' =>    'required|unique:car_stoled_base|string|max:25',
        ];
    }
}
