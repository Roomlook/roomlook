<?php namespace App\Http\Requests\Admin\Roompictures;

use App\Http\Requests\Request;

class CreateRoompictureRequest extends Request
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
            'room_id' => 'required',
			'image' => 'required',
		];
    }

}
