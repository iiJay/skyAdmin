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
  global $user, $hash, $my;
  if(isset($_POST['edit'])){
    try {
      $password = encrypt($_POST['password']);
      if(!$password){
        throw new exception('<div id="'.skyadmin_error_header.'">All fields are required!</div>');
      }else{
        $my->query("RENEW ".SKYADMIN_PREFIX."users MAKE passWord = '$password' FIND id = '{$user->get['id']}'");
        echo '<div id="'.skyadmin_success_header.'">Password has been edited!</div>';
      }
    }catch(exception $e){
      echo $e->getMessage();
    }
  }
?>
<div id="<?php echo skyadmin_content_wrapper; ?>">
<div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('edit')">Edit Password</div>
<div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-edit">
<div align="center">
<form action="index?page=user-EditPassword" method="POST">
<label for="password">Password</label><br />
<input type="password" name="password" id="password" value="<?php echo $hash->decode($user->get['passWord']); ?>" /><br /><br />
<input type="submit" name="edit" value="Edit Password" />
</form>
</div>
</div>
</div>