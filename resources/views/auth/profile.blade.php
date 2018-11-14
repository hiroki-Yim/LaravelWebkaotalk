<?php 

session_start();
require_once('../../config/config.php'); 
require_once('../../config/tools.php');
$sid = session_exist('id');
$sname = session_exist('name');
$smail = session_exist('mail');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once('./html/head.php'); ?>
  <title>Profile</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="top-header top-header--transparent">
  <?php require_once('./html/header_top.php'); ?>
    <div class="header__bottom">
      <div class="header__column">
        <a href="index.php">
          <i class="fa fa-times fa-lg"></i>
        </a>
      </div>
      <div class="header__column">

      </div>
      <div class="header__column">
        <i class="fa fa-user fa-lg"></i>
      </div>
    </div>
  </header>
  <main class="profile">
    <header class="profile__header">
      <div class="profile__header-container">
        <img src="images/person-icon.png" alt="">
        <h3 class="profile__header-title"><?=$sname?></h3>
      </div>
    </header>
    <div class="profile__container">
      <?=$smail ?>
      <div class="profile__actions">
        <div class="profile__action">
          <span class="profile__action-circle">
              <i class="fa fa-comment fa-lg"></i>
          </span>
          <span class="profile__action-title">My Chatroom</span>
        </div>
        <div class="profile__action">
          <span class="profile__action-circle">
           <i class="far fa-circle"></i>
          </span>
          <a href="../account/update_Form.php" class="profile__action-title">Edit Profile</a>
        </div>
      </div>
    </div>
  </main>

</body>
</html>
