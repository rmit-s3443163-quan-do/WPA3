<?php

    include_once('m/Cart.php');
    include_once('c/CartController.php');

    $cart = new Cart();
    $content = '<div class="center">Cart is empty!</div>';
    $b = true;
    $cls = '';
    $msg = '';

    if (isset($_SESSION['cart'])) {
        $cart = unserialize($_SESSION['cart']);
        if ($cart->getSize()>0) {
            $content = CartController::getScreenings($cart);
            $b = false;
        }
    }

    $h = '<script type="application/javascript"> window.location.href = "index.php?p=cart"; </script>';
    $a  = isset($_GET['a'])?$_GET['a']:(isset($_POST['a'])?$_POST['a']:'');

    switch ($a) {
        case 'add-to-cart':
            include_once('add-to-cart.php');
            break;
        case 'apply-voucher':
            include_once('apply-voucher.php');
            break;
        case 'remove-from-cart':
            include_once('remove-from-cart.php');
            echo $h;
            break;
        case 'empty-cart':
            session_unset();
            echo $h;
        default:
            break;
    }

?>

<div id="cart-page">
    <?php if($b) : ?>
    <?=$content?>
    <?php else: ?>
        <?=$content?>
        <table class="cart-detail">
            <tr>
                <td>Total:</td>
                <td>$<?=$cart->getGrandTotal();?></td>
            </tr>
            <tr>
                <td>Voucher <?=$cart->getVoucher();?>:</td>
                <td><?=$cart->checkVoucher()*100?>%</td>
            </tr>
            <tr>
                <td>Grand Total:</td>
                <td>$<?=$cart->getSuperTotal();?></td>
            </tr>
            <tr>
                <td>
                    <?php if(!$cart->hasVoucher()) : ?>
                    <form method="post" action="index.php">
                        <input type="hidden" name="p" value="cart"/>
                        <input type="hidden" name="a" value="apply-voucher"/>
                        <input autocomplete="off" type="text" title="12345-67890-AB" pattern="[0-9]{5}-[0-9]{5}-[A-Z]{2}" name="v" id="voucher" placeholder="Voucher code" required/>
                        <button type="submit" id="apply-voucher">Apply</button><br/>
                        <?php if($cls=='ok') : ?>
                            <span class="vc-ok">Voucher valid!</span>
                        <?php elseif ($cls =='err'): ?>
                            <span class="vc-err">Voucher invalid!</span>
                        <?php endif; ?>
                    </form>
                    <?php else: ?>&nbsp;
                    <?php endif; ?>
                </td>
                <td class="grand">
                    <div class="button" id="check-out">Check Out</div>
                    <div class="button" id="empty-cart">Empty Cart</div>
                </td>
            </tr>

        </table>
    <?php endif; ?>

</div>

<script type="application/javascript">

    $('.movie-remove').click(function () {
        id = $(this).attr('id').substr(2).split("-")[0];
        time = $(this).attr('id').substr(2).split("-")[1];
        window.location.href = 'index.php?p=cart&a=remove-from-cart&id='+id+'&time='+time;
    });
    
    $('#check-out').click(function () {
        window.location.href = 'index.php?p=check-out';
    });

    $('#empty-cart').click(function () {
        window.location.href = 'index.php?p=cart&a=empty-cart';
    });

</script>