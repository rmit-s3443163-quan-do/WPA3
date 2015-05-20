<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 3/05/15
 * Time: 11:04 PM
 */

    require_once('c/TicketController.php');
    $b = true;
    if (isset($_GET['code'])) {
        TicketController::findTicket($_GET['code'],$_GET['email']);
        $b = false;
    }

?>
<?php if($b) : ?>
    <form action="index.php" method="get">
        <input type="hidden" name="p" value="ticket"/>
    Ticket Code <input name="code" type="text"/><br/>
    Email <input name="email" type="email"/><br/>
    <input type="submit" value="Find"/>
    </form>
<?php endif; ?>