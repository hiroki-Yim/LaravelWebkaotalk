<?php

namespace App;
use App\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname', 'email', 'password', 'phone', 'gender', 'profileImg', 'confirm_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [   //엘로퀀트 쿼리 결과에서 제외할 컬럼들 지정
        'password', 'remember_token',
        'confirm_code'
    ];

    protected $cast = ['activated'=>'boolean']; //tinyint열이 string 타입으로 반환되는 경우를 방지함 열의 타입을 지정

    public function user(){
        return $this->hasMany(Message::class);
        //$this->belongsTo('nickname', 'writer');
    }

    public function friendsOfMine(){
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf(){
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends(){
        return $this->friendsOfMine->merge($this->friendOf);
    }
}
