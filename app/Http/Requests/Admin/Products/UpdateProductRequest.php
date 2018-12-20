<?php namespace App\Http\Requests\Admin\Products;

use App\Http\Requests\Request;

class UpdateProductRequest extends Request
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
            'ru.name'=>'required',
            'ru.short_body'=>'required',
            'manufacturer_id'=>'required',
            'stores'=>'required',
            'image'=>'required'
        ];
    }

}
