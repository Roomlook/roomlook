<?php namespace App\Http\Requests\Admin\Roompicturetags;

use App\Http\Requests\Request;

class CreateRoompicturetagRequest extends Request
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
            'product_id' => 'required',
            'room_picture_id' => 'required',
            'percent_top' => 'required',
            'percent_left' => 'required',
        ];
    }

}
