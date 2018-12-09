<?php
//board가 소속된 namespace 는 app, java의 패키지 개념
namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{//model에서 관계를 지어주는 작업을 해줘야 함

    //fillable 필요한 정보 가져오지 않았을 시에 에러발생
    //$hidden -> password 정보 숨김
        //mean을 여러개 가질 수 있는 관계
    //tinker -> 주소 ::(파사드)로 확인가능
       
    protected $fillable = [
        'content', 'author', 'title'
    ];

    public function user() {
    	return $this->belongsTo(User::class); //Board는 하나의 유저를 가질 수 있음
    }
    
    public function files() {  
    	return $this->hasMany(File::class);   //1개의 보드는 여러 파일을 가질 수 있음
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'writer');
    }
}
