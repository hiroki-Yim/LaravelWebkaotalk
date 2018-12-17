<?php
    function passing_time($datetime) {
      $time_lag = time() - strtotime($datetime);
      if($time_lag < 60) {
        $posting_time = "방금";
      } elseif($time_lag >= 60 && $time_lag < 3600) {
        $posting_time = floor($time_lag/60)."분 전";
      } elseif($time_lag >= 3600 && $time_lag < 86400) {
        $posting_time = floor($time_lag/3600)."시간 전";
      } elseif($time_lag >= 86400 && $time_lag < 2419200) {
        $posting_time = floor($time_lag/86400)."일 전";
      } else {
        $posting_time = date("y-m-d", strtotime($datetime));
      } 
      return $posting_time;
        }

      function attachments_path($path = '', $usersPath)
      {
          return public_path('uploadedFile\Files\users\\'.$usersPath.($path ? DIRECTORY_SEPARATOR . $path : $path));
      }
      
      function format_filesize($bytes)
      {
          if(! is_numeric($bytes)) return 'NaN';
          $decr = 1024;
          $step = 0;
          $suffix = ['bytes','KB','MB'];
          while(($bytes / $decr) > 0.9){
              $bytes = $bytes / $decr;
              $step ++;
          }
          return round($bytes, 2) . $suffix[$step];
      }

    ?>