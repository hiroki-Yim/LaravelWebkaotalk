<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateBoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() //검증규칙을 만드려고 사용
    {
        return true; //현재 사용자가 이 것을 요청할 권한이 있는지 true OR false
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()         //서버 가기전에 rules가 실행되며 제대로 값이 넘어가지 않는다면
                                    //서버로 넘어가지 않고 해당칸을 채워 달라는 문장을 발생시킴 html문법 required 쓴것과 같이!!!!!!!!!!!!!
    {
        return [                    //비지니스 로직에다가 값이 다 넘어오는지 검사하는 부분을 넣음 (extends해서 애초에 넘어올 때도 검사가능)
            'title' => 'required',  //request객체 주고 request 파라미터에게 정의할 규칙을 정의 |(var)로 연결 가능하고
            'author' => 'required', //규칙은 직접 정의해서 사용할 수도 있다.
            'content' => 'required',
        ];
    }
}
