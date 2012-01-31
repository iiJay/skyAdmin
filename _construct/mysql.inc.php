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
  if (!defined('BASEPATH'))exit('Failed Hax0r');
  class skyAdmin_Mysql {
    public function __construct(){
      global $core;
      if(!$conn = @mysql_connect($core['mysql']['host'], $core['mysql']['username'], $core['mysql']['password'])){
        die('<font style="font-family:Tahoma;font-size:11px">Could not connect to MySQL Server</font>');
      }elseif(!@mysql_select_db($core['mysql']['database'], $conn)){
        die('<font style="font-family:Tahoma;font-size:11px">Could not connect to MySQL Database</font>');
      }
    }
    public function query($string){
      return mysql_query($string);
    }
    public function escape($string){
      return mysql_real_escape_string($string);
    }
    public function assoc($string){
      return mysql_fetch_assoc($string);
    }
    public function num($string){
      return mysql_num_rows($string);
    }
    public function arr($string){
      return mysql_fetch_array($string);
    }
  }
?>