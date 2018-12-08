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

    public function __construct() {
        $this->middleware('auth');
    }

    public function imageUpload(Request $request){ //sympony method 
        $url = "";
        $image = $request->image;
        if ($request->hasFile('image')) {
            if ($image->isValid()) {
                $savename = time().'.'.$image->guessExtension(); //getMimetype
                $path = public_path()."/uploadedFile/Images/users";  //라라벨이 path를 지정 = public (/)
                $image->move($path, $savename);
                $url ="/uploadedFile/Images/users/".$savename;
                return $url;
            }else{
                return response('에러가 발생하였습니다.', 406)->header('Content-Type', 'text/plain');   //발생에러 직접 정의 가능
            }
        }else {
            return response('파일이 없습니다.', 406)->header('Content-Type', 'text/plain');
        }
        // if ($_FILES['image']['name']) {
        //     if (!$_FILES['image']['error']) {
        //         $ext = explode('.', $_FILES['image']['name']);  
        //         $filename = time().'.'.$ext[1];

        //         $destination = public_path()."/uploadedFile/Images/users".$filename;  //라라벨이 path를 지정 = public (/)
        //         \Log::error($destination);
        //         $location = $_FILES['image']['tmp_name'];
        //         move_uploaded_file($location, $destination);
        //         $url ="/uploadedFile/Images/users".$filename;
        //     }else{
        //         $url ='업로드에 실패 하였습니다.: '.$_FILES['image']['error'];
        //     }
        // }
        return $url;
        // return $request->file('image')->path();
    }    

    public function fileUpload(Request $request){
        // setlocale(LC_ALL,'ko_KR.UTF-8');
        $attachment = null;
    	\Log::error('error1');
    	if($request->hasFile('file')) {
    		$file = $request->file('file');
            $user = \Auth::user();
            $filename = $user->email."_".date("y-h.i.s")."_".$file->getClientOriginalName();   //지정된 필터로 필터함
            //return $filename;
    		$filesize = $file->getSize();
            
            
            $path = public_path().'/uploadedFile/Files/users/'.$user->email;

            // if (!File::isDirectory($path)) {
            //     File::makeDirectory($path, 0777, true, true);
            // }
            \Log::error('error2');
    		$file->move($path, $filename);
          
    		$fileInfo = [
    				'filename'=>$filename,
    				'filetype'=>$file->getClientMimeType(),
    				'filesize'=> $filesize,
    			];
    			
			$Files = File::create($fileInfo);
    	}
    	\Log::error('error3');
    	return response()->json($attachment, 200);
       

    }

    public function uploadFile(Request $request){
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
        $uploads_dir = public_path().'/uploadedFile/Files/users/';
        $extension = Input::file('file')->getClientOriginalExtension();
        $tmp_name = $_FILES["file"]["tmp_name"];
        $filename = date('Ymdhis').'_'.$_FILES["file"]["name"].'.' . $extension;
        move_uploaded_file($tmp_name, "$upload s_dir/$name");
        return $uploads_dir;
        //"/uploadedFile/Images/users/".$name;
        }
    }

    public function deleteFile(Request $request, $id){
        $filename = $request->filename;
        $attachment = File::find($id);
        $attachment->deleteUploadedFile($filename);
        $attachment->delete();
        $user = \Auth::user();
        /*
        $path = public_path('files') . DIRECTORY_SEPARATOR .  $user->id . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        */
        return $filename;  
    }
    public function modifyFile(){

    }
}
