<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeoObjectRequest extends FormRequest
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
            'name'                  => 'required',
            'description'           => 'required',
            'type_id'               => 'required|exists:types,id',
            'geometry'              => 'required',
            'geometry.*.type'       => 'required',
            'geometry.*.latitude'   => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'geometry.*.longitude'  => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ];
    }
}