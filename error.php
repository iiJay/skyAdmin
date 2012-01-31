<?php
  if(isset($_GET['system'])){
  	try {
  		$no      = (isset($_GET['no']))? $_GET['no']:'';
		$str     = (isset($_GET['str']))? $_GET['str']:'';
		$file    = (isset($_GET['file']))? $_GET['file']:'';
		$line    = (isset($_GET['line']))? $_GET['line']:'';
		$context = (isset($_GET['context']))? $_GET['context']:'';
		if(!$no or !$str or !$file or !$line or !$context){
			throw new Exception('Error');
		}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>skyAdmin Error Handler</title>
	<link href="_ui/error.css" type="text/css" rel="stylesheet" />
	
</head>

<body>
	
	<div id="top">
		<div id="skyAdmin"></div>
	</div>
	<div id="container">
		<div id="head" class="error"></div>
		Error Number: <strong><?php echo $no; ?></strong><br />
		Error String: <strong><?php echo $str; ?></strong>
		<hr size="1" /><br />
		File: <strong><?php echo $file; ?></strong>
		<hr size="1" />
		Error Line: <strong><?php echo $line; ?></strong><br />
		Context: <strong><?php echo $context; ?></strong>
	</div>
	<div id="foot">
		Powered by <strong>skyAdmin</strong>
	</div>
	
</body>
</html>

<?php
		}
  	}catch(Exception $e){
  		die('No error yet.');
  	}
  }else{
  	die();
  }
?>