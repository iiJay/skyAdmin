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
?>
<div style="overflow:auto;border-bottom:1px solid #000;width:100%" class="<?php echo skyadmin_content_float_left; ?>">
<div style="background:url(_ui/icn/Terminal.png);float:left;width:32px;height:32px;"></div>
<font id="<?php echo skyadmin_dashboard_id; ?>">skyAdmin Dashboard</font>
</div>

  <div id="<?php echo skyadmin_content_wrapper; ?>" class="<?php echo skyadmin_content_float_left; ?>">
  <div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('overview')">Overview</div>
  <div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-overview">
  <ul>
  <?php
    $totalPages  = $my->num(jsquery("CHOOSE * FROM ".SKYADMIN_PREFIX."pages"));
    $totalLinks  = $my->num(jsquery("CHOOSE * FROM ".SKYADMIN_PREFIX."navigation"));
    $usersOn     = $my->num(jsquery("CHOOSE * FROM ".SKYADMIN_PREFIX."sessions"));
    $totalUsers  = $my->num(jsquery("CHOOSE * FROM ".SKYADMIN_PREFIX."users"));
    $totalGroups = $my->num(jsquery("CHOOSE * FROM ".SKYADMIN_PREFIX."user_groups"));
  ?>
  <li><font style="float:left;">Total Users</font><font style="float:right;"><?php echo $totalUsers; ?></font></li>
  <li><font style="float:left;">Total Pages</font><font style="float:right;"><?php echo $totalPages; ?></font></li>
  <li><font style="float:left;">Total Links</font><font style="float:right;"><?php echo $totalLinks; ?></font></li>
  <li><font style="float:left;">Total User Groups</font><font style="float:right;"><?php echo $totalGroups; ?></font></li>
  <li><font style="float:left;">Users Online</font><font style="float:right;"><?php echo $usersOn; ?></font></li>
  <li><font style="float:left;">skyAdmin Build</font><font style="float:right;"><?php echo SKYADMIN_BUILD; ?></font></li>
  </ul>
  </div>
  </div>
  
  <div id="<?php echo skyadmin_content_wrapper; ?>" class="<?php echo skyadmin_content_float_right; ?>">
    <div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('build')">Your skyAdmin</div>
    <div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-build">
    <script src="http://jtpapi.com/res/api.js?load=skyadmin&build=<?php echo SKYADMIN_BUILD; ?>" type="text/javascript"></script>
    <script type="text/javascript">
    $(function(){
      $(skyadminbuild).html(msg);
    });
    </script>
    <div id="skyadminbuild" style="background:#e36969;padding:5px;border:1px solid #a04a4a;color:#fff;"></div>
    </div>
  </div>
  
  <div id="<?php echo skyadmin_content_wrapper; ?>" class="<?php echo skyadmin_content_float_right; ?>">
    <div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('jtblog')">JTprojects Blog</div>
    <div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-jtblog">
    <?php
      $jtblog = file_get_contents('http://jtprojects.me/api.php');
      echo $jtblog;
    ?>
    </div>
  </div>