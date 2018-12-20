<?php namespace App\Http\Requests\Admin\Rooms;

use App\Http\Requests\Request;

class CreateRoomRequest extends Request
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
            'ru.title' => 'required',
            'project_id' => 'required',
			'room_type_id' => 'required',
		];
    }

}
