<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 5/05/15
 * Time: 2:09 AM
 */

    require_once('c/TicketController.php');
    session_start();

    $head = 'v/head.php';
    $h = '<script type="application/javascript"> window.location.href = "ticket.php"; </script>';

    $b = false;
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $email = $_GET['email'];
        $html = TicketController::findTicket($code,$email);

        if ($html == "null") {
            echo '<script type="application/javascript">alert("Ticket Not Found!");</script>"';
            echo $h;
        } else
            $b = true;
//        $ticket->view();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Silveradio Cinema - Ticket Reservation System</title>
    <link href="./css/ticket-style.css" media="screen" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
</head>
<body>
    <?php if($b) : ?>
    <div class="center ticket-back">
        <a class="back" href="index.php?p=movies">
            < Back to <span class="yellow">Movies</span> page
        </a>
        <br/>
        Please show this webpage or print out bring to us when purchasing tickets.
    </div>

    <div id="tic-content" class="center">
        <?=$html?>
    </div>
    <?php else: ?>
    <div class="center ticket-back ticket-check">
        <form method="get" action="ticket.php">
            <label>Code</label><input id="ip-code" name="code" type="text" pattern="\d{5}" required placeholder="Input your ticket code" title="Format: 00000" />
            <label>Email</label><input name="email" type="email" placeholder="Input your email" required />
            <input type="submit" class="button co-submit" value="Check Reservation"/>
        </form>
    </div>
    <?php endif; ?>

    <?php include_once('/home/eh1/e54061/public_html/wp/debug.php');?>
</body>

</html>