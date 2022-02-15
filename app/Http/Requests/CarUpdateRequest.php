<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
            'title'             => 'required|string',
            'description'       => 'required|string',
            'category_id'       => 'required|exists:categories,id',
            'original_price'    => 'required|numeric|between:0,9999.99',
            'actual_price'      => 'required|numeric|between:0,9999.99',
            'image'             => 'file|max:11264',
            'quantity'          => 'required|integer',
            'model'             => 'required|string',
            'size'              => 'required|string',
            'registration'      => 'required|string',
            'status'            => 'required|boolean',
        ];
    }

}
