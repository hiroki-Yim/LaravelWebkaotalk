<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{   //model에서 관계를 지어주는 작업을 해줘야 함

    //fillable 필요한 정보 가져오지 않았을 시에 에러발생
    //$hidden -> password 정보 숨김
    protected $fillable = [
        'word',
    ];
    //mean을 여러개 가질 수 있는 관계
    //tinker -> 주소 ::(파사드)로 확인가능
    public function means(){
        //word칼럼에 mean을 여러개 가질 수 있다 =
        //Model에 있는 메서드 (상속됨) this로 접근
        return $this->hasMany('mean');
    }

    public function word(){
        //하나만 가지고 있다 mean는 word를 
        return $this->beLongsTo('word');
    }
}

