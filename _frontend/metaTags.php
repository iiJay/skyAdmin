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
  define('BASEPATH', 'FrontEnd_MetaTags');
  include('../_construct/conf.php');
?>
<html dir="ltr" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head> 
<title><?php echo skySite('name').' | Powered by skyAdmin'; ?></title>
<meta name="description" content="<?php echo skySite('description'); ?>" />
<meta name="keywords" content="<?php echo skySite('keywords'); ?>" />
<meta name="author" content="<?php echo skySite('author'); ?>" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<style>
body {
  background: #fff;
}
#cont {
  width: 500px;
  heigh: auto;
  margin: 0 auto;
  font-family: Comic sans ms;font-size: 11px;
}
</style>
</head>

<body>
  <div id="cont">
  	View the page's source to view the meta tags.
  </div>
</body>
</html>