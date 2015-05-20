<?php
    $p = isset($_GET['p'])?$_GET['p']:(isset($_POST['p'])?$_POST['p']:'index');
    if ($p == 'select-ticket' || $p == 'movie')
        $p = 'movies';
    if ($p == 'check-out')
        $p = 'cart';

?>

<a href="index.php"><img id="logo" src="img/logo.png" alt="cinema" /></a>
<!-- Original image below sourced for educational purposes: http://cinema.releasemyad.com -->
<img class="mob" src="img/cnm.png" alt="cinema" />
</div>
<div id="nav">
    <ul>
        <li><a id="index" href="index.php?p=index">Home</a></li>
        <li><a id="movies" href="index.php?p=movies">Movies</a></li>
        <li><a id="cart" href="index.php?p=cart">Cart</a></li>
        <li><a id="schedule" href="index.php?p=schedule">Schedule</a></li>
        <li><a id="contact" href="index.php?p=contact">Contact Us</a></li>
    </ul>
</div>

<script type="text/javascript">
    $("#<?=$p?>").addClass('selected');
</script>

<div class="mob" id="slide">
<!-- Original image below sourced for educational purposes: www.dolby.com -->
<img src="img/banner2.jpg" alt="banner2" />