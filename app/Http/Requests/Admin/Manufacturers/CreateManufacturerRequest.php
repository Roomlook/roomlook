<?php namespace App\Http\Requests\Admin\Manufacturers;

use App\Http\Requests\Request;

class CreateManufacturerRequest extends Request
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
            
            'ru.name' => 'required'
        ];
    }

}
