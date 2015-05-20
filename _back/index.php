<?php
	session_start();

	$head = 'v/head.php';
    $nav = 'v/nav.php';
    $foot = 'v/foot.php';

    $_COOKIE['abc'] = "abc";


    $valid = ['index','movies','movie','contact','schedule','select-ticket','cart','check-out','ticket'];
    $page  = isset($_GET['p'])?$_GET['p']:(isset($_POST['p'])?$_POST['p']:'index');

    if (is_null($page)) {
		$content = 'v/index.php';
	} else if (in_array($page, $valid)) {
		$content = 'v/'.$page.'.php';
	}

?>
<!DOCTYPE html>
<html>
<head> 
    <?php include_once($head); ?>
</head>
<body>
    <div id="main">
        <div id="head">
            <?php include_once($nav); ?>
        </div>
        <div id="content">
            <?php include_once($content); ?>
        </div>
        <div id="footer">
            <?php include_once($foot); ?>
        </div>
    </div>
    <?php include_once('/home/eh1/e54061/public_html/wp/debug.php');?>
</body>
</html>