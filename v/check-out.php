<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 3:55 PM
 */
    include_once('c/TicketController.php');

    if (isset($_SESSION['cart'])) {
        $cart = unserialize($_SESSION['cart']);

        if (isset($_POST['name'])) {

            $str=TicketController::addTicket($_POST['name'], $_POST['phone'], $_POST['email'], $cart);

            session_unset();

            $b = false;
        } else {
            $b = true;
        }
    }
?>

<?php if($b) : ?>
    <div id="co-content">
        <div class="co-title">Just one step away..</div>
        <div class="co-title">Please fill in your detail</div>
        <div id="co-form">
            <form id="fInfo" action="index.php?p=check-out" method="post">
                <label>Name</label><input name="name" type="text" pattern="^[A-Za-z\s']+$" required placeholder="Input your name" />
                <label>Email</label><input name="email" type="email" placeholder="quan.dhz@gmail.com" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="youremail@mail.com"/>
                <label>Phone</label><input name="phone" type="tel" pattern="^(\+614|\(04\)|04)[\d\s]+$" placeholder="0412 345 678" required title="ie: 0412 345 678"/>
                <input type="submit" class="button co-submit" value="Reserve Ticket"/>
            </form>
        </div>
    </div>

    <script type="application/javascript">
        $('#btSubmit').click(function () {
            $('#fInfo').submit();
        });
    </script>


<?php else: ?>
    <script type="application/javascript">
        window.location.href = '<?=$str?>';
    </script>
<?php endif; ?>