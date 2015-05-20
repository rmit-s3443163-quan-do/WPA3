<?php

    require_once('c/Reservation.php');

    $hid = '<div class="seat hidden"></div>';
    $stRight = Reservation::getContent('['.$_GET['id'].'] '.$_GET['name'],$_GET['day'].' '.$_GET['time']);
?>
<form id="ticket-form" method="post" action="index.php?p=cart&a=add-to-cart">
<div id="select-ticket" class="center">
    <a class="back" href="index.php?p=movies">
        < Back to <span class="yellow">Movies</span> page
    </a>
    <div id="st-content">
        <div id="st-left">
            <div class="label">Movie</div>
            <div class="bgg">[<?=$_GET['id']?>] <?=$_GET['name']?></div>
            <input type="hidden" name="title" value="[<?=$_GET['id']?>] <?=$_GET['name']?>"/>

            <div class="label">Session</div>
            <div class="cont"><?=$_GET['day']?> <?=$_GET['time']?></div>
            <input id="session-time" type="hidden" name="session" value="<?=$_GET['day']?> <?=$_GET['time']?>"/>

            <div class="label">Seats</div>
            <div id="selectedSeats" class="seats-selected cont"></div>
            <input id="seatValues" type="hidden" name="seats"/>

            <div class="label">Ticket</div>
            <div id="ticket-list"></div>
        </div>
        <div id="st-right">
        </div>
    </div>

    <div class="center whole">
        <div class="button" id="btCart">Add to Cart</div>
    </div>

</div>
</form>

<script type="application/javascript">

    $('#st-right').html('<?=$stRight?>');
    $('#ticket-list').html(ticketList);
    $(".tk-ip").change(function () {
        updatePrice($(this).attr('id'),$('#session-time').val());
        countSeatType();
    });
    $('#btCart').click(function () {
        if ($('#fstotal').text() == '$0.00')
            alert('Please select ticket.');
        else if ($('#remaining-seats').text() != '')
            alert('Please select seat.');
        else
            $('#ticket-form').submit();

    });
    $('#st-right .seat').click(function () {

        var id = $(this).attr('id');

        if (id != null && !$(this).hasClass('na')) {

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#ss'+id).remove();

            } else {
                $(this).addClass('selected');
                var html = $('#selectedSeats').html();
                html += '<span id="ss' + id + '" class="seat-selected">' + id + '</span>';
                $('#selectedSeats').html(html);
            }
        }

        countSeatType();

    });
    setMap('000');

</script>