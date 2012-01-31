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
  global $my;
?>
<div id="<?php echo skyadmin_content_wrapper; ?>">
<div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('newUser')">Create new user</div>
<div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-newUser">
<div align="center">
<?php
  if(isset($_POST['create'])){
    try {
      $username  = clean($_POST['username']);
      $password  = encrypt($_POST['password']);
      $email     = clean($_POST['email']);
      $ip        = clean($_POST['ip']);
      $group     = implode(',', $_POST['userGroup']);
	  $findUser  = $my->num(jsquery("CHOOSE * AT ".SKYADMIN_PREFIX."users FIND username = '$username'"));
      if(!$username or !$password or !$email or !$ip or !$group){
        throw new exception('<div id="'.skyadmin_error_header.'">All fields are required!</div>');
	  }elseif($findUser == 1){
	  	throw new exception('<div id="'.skyadmin_error_header.'">Username was taken!</div>');
      }else{
        jsquery("FILL INTO ".SKYADMIN_PREFIX."users VALUES (NULL, '$username', '$password', '$email', '$group', '$ip')");
        echo '<div id="'.skyadmin_success_header.'">User has been created</div>';
      }
    }catch(exception $e){
      echo $e->getMessage();
    }
  }
  $ug = '';
  $query = jsquery("CHOOSE * AT ".SKYADMIN_PREFIX."user_groups");
  while($c = $my->arr($query))
  {
    $ug .= '<input type="checkbox" name="userGroup[]" value="'.$c['id'].'" /><font style="color:#'.$c['color'].';">'.$c['name'].'</font><br />';
  }
  echo '<form action="index?page=admin-NewUser" method="POST">
        <label for="username">Username</label> <span id="manageUser"></span><br />
        <input type="text" name="username" id="username" />
        <br /><br />
        <label for="password">Password</label><br />
        <input type="password" name="password" id="password" />
        <br /><br />
        <label for="email">Email</label><br />
        <input type="text" name="email" id="email" />
        <br /><br />
        <label for="ip">I.P. Address</label><br />
        <input type="text" name="ip" id="ip" /><br /><br />
        User Group<br />'.$ug.'<br /><br />
        <input type="submit" name="create" value="Create User" />
        </form>';
?>
</div>
</div>
</div>
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