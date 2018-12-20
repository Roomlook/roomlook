<?php 

namespace App\Http\Requests\Admin\Papers;

use App\Http\Requests\Request;

class CreatePaperRequest extends Request
{
	
    public function authorize()
    {
        return true;
    } 
	
    public function rules()
    {
        return [
            'ru.name' => 'required' 
        ];
    }

}
