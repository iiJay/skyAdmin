<?php
   /*Copyright (C) 2011 by JTprojects (Jian Ting)

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
  if(!defined('BASEPATH')) die();
  if(isset($_POST['submit'])){
  	try {
  		$secure_hash  = rand(1, 100000);
         //SQL Settings
         $sql_username = $_POST['m_username'];
         $sql_password = $_POST['m_password'];
         $sql_database = $_POST['m_database'];
         $sql_host     = $_POST['m_host'];
	     $sql_prefix   = $_POST['m_prefix'];
		 if(!$sql_username or !$sql_password or !$sql_database or !$sql_host or !$sql_prefix){
		 	throw new Exception('<div id="red">All fields are required!</div>');
		 }elseif(!$conn = @mysql_connect($sql_host, $sql_username, $sql_password)){
		 	throw new Exception('<div id="red">skyAdmin could not connect to the MySQL Server</div>');
		 }elseif(!@mysql_select_db($sql_database, $conn)){
		 	throw new Exception('<div id="red">skyAdmin could not select the MySQL Database.</div>');
		 }else{
		 	define('PREFIX', $sql_prefix);
			$config = file_get_contents('conf.php');
            $config = str_replace('<host>', $sql_host, $config);
            $config = str_replace('<username>', $sql_username, $config);
            $config = str_replace('<password>', $sql_password, $config);
            $config = str_replace('<database>', $sql_database, $config);
            $config = str_replace('<hash>', $secure_hash, $config);
		    $config = str_replace('<prefix>', $sql_prefix, $config);
            file_put_contents('../_construct/conf.php', $config);
			include('../_construct/conf.php');
			$create_1 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."chat` (`id` int(11) NOT NULL AUTO_INCREMENT, `content` varchar(255) NOT NULL, `time` int(11) NOT NULL, `userId` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
			$create_2 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."navigation` (`id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL, `link` varchar(255) NOT NULL, `userGroup` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;");
			$create_3 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."pages` (`id` int(11) NOT NULL AUTO_INCREMENT, `title` varchar(255) NOT NULL, `show_title` varchar(255) NOT NULL, `cont` text NOT NULL, `userId` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");
			$create_4 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."sessions` (`id` int(255) NOT NULL AUTO_INCREMENT, `userId` int(11) NOT NULL, `ip` varchar(255) NOT NULL, `time` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
			$create_5 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."users` (`id` int(11) NOT NULL AUTO_INCREMENT, `userName` varchar(255) NOT NULL, `passWord` varchar(255) NOT NULL, `eMail` varchar(255) NOT NULL, `userGroup` text NOT NULL, `ip` varchar(255) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
			$create_6 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."user_groups` (`id` int(11) NOT NULL AUTO_INCREMENT, `delete` int(11) NOT NULL, `name` varchar(255) NOT NULL, `color` varchar(6) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;");
			$create_7 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."site_settings` (`id` int(11) NOT NULL AUTO_INCREMENT, `site_name` varchar(255) NOT NULL, `site_description` text NOT NULL, `site_author` text NOT NULL, `site_keywords` text NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
			$create_8 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."logs` (`id` int(11) NOT NULL AUTO_INCREMENT, `error_code` int(11) NOT NULL, `user_id` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
			$create_9 = mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."crons` (`id` int(11) NOT NULL AUTO_INCREMENT, `cron_name` varchar(255) NOT NULL, `cron_desc` text NOT NULL, `cron_path` text NOT NULL, `last_ran` int(11) NOT NULL, `enabled` int(11) NOT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
		    if(!$create_1 or !$create_2 or !$create_3 or !$create_4 or !$create_5 or !$create_6 or !$create_7 or !$create_8 or !$create_9){
		    	throw new Exception('<div id="red">skyAdmin could not create required tables.</div>');
		    }else{
		    	$insert_1 = mysql_query("INSERT INTO `".PREFIX."navigation` (`id`, `name`, `link`, `userGroup`) VALUES (1, 'Home', 'index.php/user-Home', 1), (2, 'Manage Users', '/index.php/admin-ManageUser', 2), (3, 'Logout', '/index.php/user-Logout', 1), (4, 'Add User', '/index.php/admin-NewUser', 2), (5, 'Chat', '/index.php/user-Chat', 1), (6, 'Add Link', '/index.php/admin-CreateNav', 2), (8, 'Manage Link', '/index.php/admin-ManageNav', 2), (9, 'Add Page', '/index.php/admin-AddPage', 2), (10, 'Manage Pages', '/index.php/admin-ManagePage', 2), (11, 'Manage User Groups', '/index.php/admin-ManageGroups', 2), (12, 'Add User Group', '/index.php/admin-AddGroup', 2), (13, 'Edit Email', '/index.php/user-EditEmail', 1), (15, 'Site Settings', '/index.php/admin-SiteSettings', 2), (16, 'Panel Logs', '/index.php/admin-ViewLogs', 2), (17, 'Cron Jobs', '/index.php/admin-ManageCrons', 2), (18, 'Edit Password', '/index.php/user-EditPassword', 1), (19, 'Manage Sessions', '/index.php/admin-ManageSessions', 1);");
	            $insert_2 = mysql_query("INSERT INTO `".PREFIX."pages` (`id`, `title`, `show_title`, `cont`, `userId`) VALUES (1, 'example', 'Example', '<p>This is an example page.</p>\r\n<p>Text editor by <strong>TinyMCE</strong></p>\r\n<p><strong><br /></strong>This site is powered by <strong>skyAdmin</strong> by <strong>JTprojects</strong>.</p>', 1);");
	            $insert_3 = mysql_query("INSERT INTO `".PREFIX."user_groups` (`id`, `delete`, `name`, `color`) VALUES (1, 1, 'User', '262626'), (2, 1, 'Admin', 'cfa134');");	
				$insert_4 = mysql_query("INSERT INTO `".PREFIX."crons` (`id`, `cron_name`, `cron_desc`, `cron_path`, `last_ran`, `enabled`) VALUES (1, 'Build Auto-Upgrade', 'Automatically upgrade your current skyAdmin build. Only if there\'s any upgrade available', 'cron_scripts/checkBuild.php', '0', '1')");  
				if(!$insert_1 or !$insert_2 or !$insert_3 or !$insert_4){
					throw new Exception('<div id="red">skyAdmin could not insert required table data.</div>');
				}else{
					header('Location: ?step=2');
				}
			}
		 }
  	}catch(Exception $e){
  		echo $e->getMessage();
  	}
  }
?>
<form action="?step=1" method="POST">
	MySQL Settings
    <hr size="1" />
    <label for="m_username">MySQL Username</label><br />
    <input type="text" name="m_username" id="m_username" /><br /><br />
    <label for="m_password">MySQL Password</label><br />
    <input type="text" name="m_password" id="m_password" /><br /><br />
    <label for="m_database">MySQL Database</label><br />
    <input type="text" name="m_database" id="m_database" /><br /><br />
    <label for="m_host">MySQL Host (e.g. localhost)</label><br />
    <input type="text" name="m_host" id="m_host" /><br /><br />
    <label for="m_prefix">SQL Prefix (Do not change if you don't know what it does.)</label><br /><br />
    <input type="text" name="m_prefix" id="m_prefix" value="sky_" /><br /><br />
    <div align="center"><input type="submit" name="submit" value="Continue" /> to step 2</div>
</form>
