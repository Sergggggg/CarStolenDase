<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAvtoRequest extends FormRequest
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
        $this->redirect = url()->previous(); 

        return [
            
            'name' => 'required|string|max:50',
            'number' => 'required|unique:car_stoled_base,number, '.$this->id,
            'color'=> 'required|string|max:15',
            'vin' => 'required|unique:car_stoled_base,vin, '.$this->id,
            'marka'=>'required|string|max:25',
            'model'=>'required|string|max:25',
            'year'=>'required|digits:4|integer',
        ];
    }
}
