<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadedFile extends Model {
    protected $table = "uploaded_files";
    public $timestamps = false;
    public $fillable = ['comment'];
    public function imagePath() {
        return 'images/rooms/'.$this->path;
    }
    
}
