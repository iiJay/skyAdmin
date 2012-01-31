<?php
  /*
   Copyright (C) 2011 by JTprojects (Jian Ting)

   Permission is hereby granted, free of charge, to any person obtaining a copy
   of this software and associated documentation files (the "Software"), to deal
   in the Software without restriction, including without limitation the rights
   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
   copies of the Software, and to permit persons to whom the Software is
   furnished to do so, subject to the following conditions:

   The above copyright notice and this permission notice shall be included in
   all copies or substantial portions of the Software.

   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
   IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
   AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
   LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
   OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
   THE SOFTWARE.
   */
  session_start();
  define('BASEPATH', 'noHax0r');
  include(dirname(__FILE__).'/_construct/conf.php');
?>
<html dir="ltr" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration | Powered by skyAdmin</title>
<link href="_ui/layout.css" type="text/css" rel="stylesheet" />
<script src="jscripts/jquery.js" type="text/javascript"></script>
</head>

<body>

  <?php
    if($user->loggedIn){
  ?>
  <div id="wrapper">
  <div id="left">
    <div id="skyPanel"></div>
    <div id="welcome">
      Welcome to <i>skyAdmin</i>, <strong><?php echo $user->get['userName']; ?></strong>
    </div>
    <div id="left_cont">
      <?php
        echo $user->userNav();
      ?>
    </div>
  </div>
  <div id="main">
    <?php
        /* This is deprecated. Pages will not be compatible with this anymore. */
       /* This is kept for referrence */
      /* Used by versions below 2.2.5 */
        $pagedb = scandir('_resource');
        unset($pagedb[0], $pagedb[1]);
        if(isset($_GET['page'])){
          if(in_array($_GET['page'].'.php', $pagedb)){
            include(dirname(__FILE__).'/_resource/'.$_GET['page'].'.php');
          }else{
            echo 'Forbidden';
          }
        }else{
          include('_resource/user-Home.php');
        }
    ?>
  </div>
  </div>
  <?php
    }else{
      if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user->login($username, $password);
        echo $ui->redirect('index');
      }
  ?>
  <div align="center">
  <div id="content">
    <div id="header" onclick="accordionContent('trouble')">Troubleshooting</div>
    <div id="words" class="accordionContent-trouble" style="display:none;">
      Have problems logging in? Your username or password might be wrong. Or someone else is already logged in using the same username.
    </div>
  </div>
  <div id="content">
    <div id="header" onclick="accordionContent('login')">Login</div>
    <div id="words" class="accordionContent-login">
     <form action="" method="POST">
  <?php
    echo $ui->buildForm(
                        'text',
                        'username',
                        'Username'
                        );
    echo '<br /><br />';
    echo $ui->buildForm(
                        'password',
                        'password',
                        'Password'
                        );
    echo '<br /><br />';
  ?>
  <input type="submit" name="login" value="Login" />
  </form>
    </div>
  </div>
  </div>
  <?php
    }
  ?>
    <div id="footer">
    &copy; skyAdmin by JTprojects
    </div>

<script src="jscripts/panel.js" type="text/javascript"></script>
</body>
</html>