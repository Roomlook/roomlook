<?php namespace App\Http\Requests\Admin\Tags;

use App\Http\Requests\Request;

class UpdateTagRequest extends Request
{ 
    public function authorize()
    {
		
        return true;
    }
 
    public function rules()
    {
        return [];
    }

}
