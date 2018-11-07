

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once('./html/head.php'); ?>
  <title>Chat</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="body-chat">
  <header class="top-header chat-header">
    <?php require_once('./html/header_top.php'); ?>
    <div class="header__bottom">
      <div class="header__column">
        <a href="chats.php">
          <i class="fa fa-chevron-left fa-lg"></i>
        </a>
      </div>
      <div class="header__column">
        <span class="header__text">Lynn</span>
      </div>
      <div class="header__column">
        <i class="fa fa-search"></i>
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </header>
  <main class="chat">
    <div class="date-divider">
      <span class="date-divider__text">Wednesday, August 2, 2017</span>
    </div>
    <div class="chat__message chat__message-from-me">
      <span class="chat__message-time">17:55</span>
      <span class="chat__message-body">
        Hello! This is a test message.
      </span>
    </div>
    <div class="chat__message chat__message--to-me">
      <img src="images/person-icon.png" class="chat__message-avatar">
      <div class="chat__message-center">
        <h3 class="chat__message-username">Lynn</h3>
        <span class="chat__message-body">
          And this is an answer
        </span>
      </div>
      <span class="chat__message-time">19:35</span>
    </div>
  </main>
  <div class="type-message">
    <i class="fa fa-plus fa-lg"></i>
    <div class="type-message__input">
      <input type="text">
      <i class="fa fa-smile-o fa-lg"></i>
      <span class="record-message">
      <i class="fas fa-comment"></i>
      </span>
    </div>
  </div>
</body>
</html>
