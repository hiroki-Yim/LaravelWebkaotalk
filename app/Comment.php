<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'content', 'writer', 'postnum', 'commentImg'
    ];

    public function board(){
        return $this->belongsTo('App\Board', 'postnum');    //fk의 default값이 post_id이니, 실 칼럼값인 postnum을 fk로 설정함
    }

    protected $hidden = [   //엘로퀀트 쿼리 결과에서 제외할 컬럼들 지정
        "_token"
    ];
}
