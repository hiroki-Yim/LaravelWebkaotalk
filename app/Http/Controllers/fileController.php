<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\File;
use App\Board;


class fileController extends Controller
{
    public function imageUpload(Request $request){
        $return_value = "";
        if ($_FILES['image']['name']) {
        if (!$_FILES['image']['error']) {
        $ext = explode('.', $_FILES['image']['name']);  
        $filename = time().'.'.$ext[1];

        $destination = public_path()."/uploadedFile/Images/users".$filename;  //라라벨이 path를 지정 = public (/)
        \Log::error($destination);
        $location = $_FILES['image']['tmp_name'];
        move_uploaded_file($location, $destination);
        $return_value ="/uploadedFile/Images/users".$filename;
        }else{
        $return_value ='업로드에 실패 하였습니다.: '.$_FILES['image']['error'];
        }
        }
        return $return_value;
    }    

    public function fileUpload(){
        $file = Input::file('file');
        $fileArray = array('image' => $file);
        $rules = array(
        'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );
        $validator = Validator::make($fileArray, $rules);
        //
        if ($validator->fails()){
        $error = 'Invalid file type / size';
        return $error;
        }else{
        $uploads_dir = public_path().'/uploadedFile/Images/users/';
        $extension = Input::file('file')->getClientOriginalExtension();
        $tmp_name = $_FILES["file"]["tmp_name"];
        $name = $filename = date('Ymdhis').'_'.$_FILES["file"]["name"].'.' . $extension;
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        return $uploads_dir;
        //"/uploadedFile/Images/users/".$name;
        }

    }

    public function uploadFile(){

    }

    public function deleteFile(){

    }
    public function modifyFile(){

    }
}
