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
  if(file_exists('skyadmin_lock.lock')){
  	die('<font style="font-family:Tahoma;font-size:11px;text-align:center;">skyAdmin is already installed.<br />
  	                                                                        Wan\'t to re-install? Please delete the
  	                                                                        <code>skyadmin_lock.lock</code> file.
  	                                                                        </font>');
  }
  define('BASEPATH', 'Installation');
  ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Installing skyAdmin</title>
	<link href="../_ui/error.css" type="text/css" rel="stylesheet" />
	
</head>

<body>
	
	<div id="top">
		<div id="skyAdmin"></div>
	</div>
	<div id="container">
		<div id="head" class="install"></div>
		<?php
		  if(isset($_GET['step'])){
		  	$step = $_GET['step'];
			  switch($step){
			  	case '1':
					  include('_resource/step_1.php');
					  break;
			    case '2':
					include('_resource/step_2.php');
					break;
				case '3':
					include('_resource/step_3.php');
					break;
			  }
		  }else{
		  	header('Location: ?step=1');
		  }
		?>
	</div>
	<div id="foot">
		Powered by <strong>skyAdmin</strong>
	</div>
	
</body>
</html>
<?php
  ob_end_flush();
?>