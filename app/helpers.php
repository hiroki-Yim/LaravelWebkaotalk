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
    ?>