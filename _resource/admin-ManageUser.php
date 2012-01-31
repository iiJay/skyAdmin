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
  if(!defined('BASEPATH'))die();
    if(isset($_GET['id'])){
      $id     = clean($_GET['id']);
      $uquery = jsquery("CHOOSE * AT ".SKYADMIN_PREFIX."users FIND id = '$id'");
      if($my->num($uquery) !== 0){
        $arr = $my->arr($uquery);
?>
<div id="<?php echo skyadmin_content_wrapper; ?>" class="<?php echo skyadmin_content_float_right; ?>">
<div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('manage')">Edit <?php echo $arr['userName']; ?></div>
<div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-manage">
<div align="center">
<?php
  if(isset($_POST['edit'])){
    try {
      $username  = clean($_POST['username']);
      $password  = encrypt($_POST['password']);
      $email     = clean($_POST['email']);
      $ip        = clean($_POST['ip']);
      $group     = implode(',', $_POST['userGroup']);
      if(!$username or !$password or !$email or !$ip or !$group){
        throw new exception('<div id="'.skyadmin_error_header.'">All fields are required!</div>');
      }else{
        jsquery("RENEW users MAKE userName = '$username' FIND id = '$id'");
        jsquery("RENEW users MAKE passWord = '$password' FIND id = '$id'");
        jsquery("RENEW users MAKE eMail = '$email' FIND id = '$id'");
        jsquery("RENEW users MAKE userGroup = '$group' FIND id = '$id'");
        jsquery("RENEW users MAKE ip = '$ip' FIND id = '$id'");
        echo '<div id="'.skyadmin_success_header.'">User has been successfully been edited</div>';
      }
    }catch(exception $e){
      echo $e->getMessage();
    }
  }
  echo '<form action="index?page=admin-ManageUser&id='.$id.'" method="POST">
        <label for="username">Username</label> <span id="manageUser"></span><br />
        <input type="text" name="username" id="username" value="'.$arr['userName'].'" />
        <br /><br />
        <label for="password">Password</label><br />
        <input type="password" name="password" id="password" value="'.$hash->decode($arr['passWord']).'" />
        <br /><br />
        <label for="email">Email</label><br />
        <input type="text" name="email" id="email" value="'.$arr['eMail'].'" />
        <br /><br />
        <label for="ip">I.P. Address</label><br />
        <input type="text" name="ip" id="ip" value="'.$arr['ip'].'" /><br /><br />
        User Group<br />'.$ui->getCheckboxGroup($id).'<br /><br />
        <input type="submit" name="edit" value="Update '.$arr['userName'].'\'s Information" />
        </form>';
?>
</div>
</div>
</div>
<?php
      }else{
        echo '<div id="'.skyadmin_error_header.'">User doesn\'t exist</div>';
      }
    }
    echo '<div id="content" class="left">
          <div id="header" onclick="accordionContent(\'view\')">Manage Users</div>
          <div id="words" class="accordionContent-view">
          <ul>';
    $query = mysql_query("SELECT * FROM ".SKYADMIN_PREFIX."users");
    while($u = $my->arr($query))
    {
      echo '<li class="user" name="'.$u['id'].'">'.$u['userName'].'
            <a href="index?page=admin-ManageUser&id='.$u['id'].'"><img src="_ui/icn/Rename Document.png" title="Edit User" /></a>
            <a href="#" name="'.$u['id'].'" onclick="deleteUser(\''.$u['id'].'\')"><img src="_ui/icn/Minus Red Button.png" title="Delete User" /></a>
            </li>';
    }
    echo '</div>
          </ul>
          </div>';
?>
<script type="text/javascript">
$('#username').keyup(function(){
  var name = $('#username').val();
  $.ajax({
    type: 'POST',
    url: 'ajax.php',
    data: 'mode=usernameCheck&username=' + name,
  }).done(function(msg){
    $('#manageUser').html(msg);
  });
});
</script>