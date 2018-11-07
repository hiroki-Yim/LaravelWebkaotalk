<?php 
  // session_start();
  // require_once('../../config/config.php'); 
  // require_once('../../config/tools.php');
  // $sid = session_exist('id');
  // $sname = session_exist('name');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  @yield('head')
</head>
<body>
  @yield('header-top')
  @yield('mainContent')
  @yield('chatsContent')
  @yield('loginmodal')
  @yield('registerFormContent')
  @yield('footer')

</body>
</html>
