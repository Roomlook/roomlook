<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Dimsav\Translatable\Translatable;
class Style extends Model {
	use Translatable;
    protected $table = 'styles';
    public $translationModel = 'App\Models\StyleTranslation';
    public $translatedAttributes = ['name' ];
    protected $fillable = ['name'];
    public static function lists($column,$key = null)
    {
        return Style::leftJoin('styles_translations', 'styles.id', '=', 'styles_translations.style_id')
            ->where('locale', '=', 'ru')->lists($column,'styles_translations.style_id');
    }
    public function rooms() {
        return $this->belongsToMany("App\Models\Room","style_room");
    }
}
