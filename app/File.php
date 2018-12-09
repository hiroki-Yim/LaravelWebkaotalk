<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Board;

class File extends Model
{
        protected $fillable = [
            'filename', 'filesize', 'filetype', 'savename'
        ];
        
        public function board() {
            return $this->belongsTo('App\Board', 'postid'); //defualt값 board_id, -> postid 
        }

        public function getUrlAttribute() {
            return url('uploadedFile/File/users/'. \Auth::user()->email . '/' . $this->filename);
        }

        public function deleteUploadedFile($filename) {             //구동환경에 따라 달라짐 window \ 리눅스 /
            $path = public_path('uploadedFile/File/users') . DIRECTORY_SEPARATOR .  \Auth::user()->email  . DIRECTORY_SEPARATOR . $filename;
            if (file_exists($path)) {
                unlink($path);
            }
       }
}
