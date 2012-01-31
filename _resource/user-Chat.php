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
  global $user;
?>
<style>
#chatBox {
  height: 300px;
  padding: 5px;
  border: 1px solid #ededed;
  word-wrap: break-word;
  overflow: auto;
}
</style>
<script>
 $(document).ready(function() {
   $("#chatBox").load("chat-ajax.php?get=getChat");
   var refreshId = setInterval(function() {
      $("#chatBox").load('chat-ajax.php?get=getChat');
   }, 5000);
   $.ajaxSetup({ cache: false });
});
</script>
<div id="<?php echo skyadmin_content_wrapper; ?>" class="left">
  <div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('chatbox')">Chatbox</div>
  <div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-chatbox">
  <div id="chatBox">
  </div>
  </div>
</div>
<div id="<?php echo skyadmin_content_wrapper; ?>" class="right">
<div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('talk')">Talk-field</div>
<div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-talk">
<form action="" method="POST" id="chatForm">
    <input type="text" name="message" style="width:415px;" id="message" />
    <input type="text" name="userId" style="display:none" value="<?php echo $user->get['id']; ?>" />
    <input type="submit" name="post" value="Post" />
</form>
</div>
</div>
<?php
  if($user->isAdmin){
?>
<div id="<?php echo skyadmin_content_wrapper; ?>" class="right">
<div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('admin')">Admin Options</div>
<div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-admin">
<a href="#" onclick="emptyChat()"><img src="_ui/icn/Trash Full.png" style="float:right:margin-left:5px;margin-right:5px;" title="Empty Shoutbox" /></a>
</div>
</div>
<div id="n" style="display:none;"></div>
<?php
  }
?>
<script src="jscripts/chat.js" type="text/javascript"></script>