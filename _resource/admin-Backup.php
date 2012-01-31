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
  	/*
	 * Might not work. Only for Linux-based System
	 * For this to work, you need your host to enable shell_exec for you hosting account.
	 */
  	$backup_sql = '../_construct/'.$core['mysql']['b_sql'];//Getting the SQL File
	$username   = $core['mysql']['username'];//Getting MySQL Username
	$password   = $core['mysql']['password'];//Getting MySQL Password
	$database   = $core['mysql']['database'];//Getting MySQL Database to retrieve data from.
	if(shell_exec("mysqldump -u$username -p$password $database > $backup_sql")){//Check if shell_exec is true
		echo 'You MySQL backup has been written in a SQL file in your <code>_construct</code> directory.';//Prints results into SQL File
	}else{//Or else
		echo 'Error - Could not execute <code>shell_exec</code>.';//Shell_exec false.
	}
?>
