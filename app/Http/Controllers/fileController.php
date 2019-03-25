<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\File;
use App\Board;
use App\User;

class fileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function imageUpload(Request $request)
    { //sympony method 
        $url = "";
        $image = $request->image;
        if ($request->hasFile('image')) {
            if ($image->isValid()) {
                $savename = time() . '.' . $image->guessExtension(); //getMimetype
                $path = public_path() . "/uploadedFile/Images/users";  //라라벨이 path를 지정 = public (/)
                $image->move($path, $savename);
                $url = "/uploadedFile/Images/users/" . $savename;
                return $url;
            } else {
                return response('에러가 발생하였습니다.', 406)->header('Content-Type', 'text/plain');   //발생에러 직접 정의 가능
            }
        } else {
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

    public function fileUpload(Request $request)
    {
        // setlocale(LC_ALL,'ko_KR.UTF-8');
        $attachment = null;
        \Log::error('error1');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $user = \Auth::user();
            $filename = $user->nickname . "_" . date("y-h.i.s") . "_" . $file->getClientOriginalName();
            //return $filename;
            $filesize = $file->getSize();
            $savename = $file->getClientOriginalName();

            $path = public_path() . '/uploadedFile/Files/users/' . $user->email;

            // if (!File::isDirectory($path)) {
            //     File::makeDirectory($path, 0777, true, true);
            // }
            \Log::error('error2');
            $file->move($path, $filename);

            $fileInfo = [
                'filename' => $filename,
                'filetype' => $file->getClientMimeType(),
                'filesize' => $filesize,
                'savename' => $savename,
            ];

            $attachment = File::create($fileInfo);  //file을 비동기방식으로 업로드 한 뒤 
        }
        \Log::error('error3');
        return response()->json($attachment, 200);  //업로드 된 파일의 정보를 front에 전달
    }

    public function deleteFile(Request $request, $id)
    {
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

    public function downloadFile(File $file)
    {
        $userPath = User::select('email')->where('nickname', Board::select('author')->where('postid', $file->postid)->first('author')->author)->first('email')->email;
        //  return $userPath;
        // return $file;
        $path = attachments_path($file->filename, $userPath); //helpers function
        //  return $path; //Log::error('fileController downloadFile attachments_path');
        $savename = $file->savename;
        // return $savename;

        if (!\File::exists($path)) {
            abort(404);
        };

        $filetype = $file->filetype;

        return response()->download($path, $savename);
    }
    public function modifyFile()
    { }
}
