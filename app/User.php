<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

// use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends \Pingpong\Admin\Entities\User implements AuthenticatableContract, CanResetPasswordContract,BillableContract {

	use Authenticatable, CanResetPassword, Billable;
	// use EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password','fb','vk','instagram','twitter', 'site', 'name_en'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	public function roles() {
		return $this->belongsToMany(\Pingpong\Trusty\Role::class, 'role_user');
	}

	public function requestToAuthor(){
		return $this->hasOne('App\Models\RequestToAuthor');
	}
	public function hasRequestToAuthor(){
		return $this->requestToAuthor;
	}
	public function author(){
		return $this->hasOne('App\Models\Author');
	}
	public function setEmailAttribute($value)
	{
	    $this->attributes['email'] = strtolower($value);
	}
	public function getEmailAttribute($value)
	{
	    return strtolower($value);
	}
	public function getRequestToAuthorClassName(){
		if($this->requestToAuthor){
			$status = $this->requestToAuthor->status;
			if($status == 'waiting'){
				return ['class'=>'btn-warning','text'=>'Ваша заявка ожидает потверждения'];
			}elseif($status == 'approved'){
				return ['class'=>'btn-default','text'=>'Вы являетесь автором'];
			}else if($status == 'declined'){
				return ['class'=>'btn-danger','text'=>'Вам отказали в авторстве'];
			}
		}else{
			return ['class'=>'btn-success','text'=>'Подать заявку на автора'];
		}

	}
	public function ownrooms() {
		return $this->hasMany('App\Models\OwnRoom');
	}
	public function getNameAttribute($value)
    {
    	if ($this->author && \App::getLocale() == 'en')
    		return $this->name_en;
        return $value;
    }
    

}
