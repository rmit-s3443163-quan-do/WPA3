<?php
    $server = 'jupiter.csit.rmit.edu.au';
    if (isset($_SERVER['SERVER_NAME'])) {
        if ($_SERVER['SERVER_NAME'] != 'localhost')
            $server = $_SERVER['SERVER_NAME'];
    }
?>

<span class="h2">
    NEW IN <span class="bigyellow">CINEMA</span>
</span>
<div id="movies-content">
</div>

<script type="application/javascript">
    url = "http://<?=$server;?>/~e54061/wp/movie-service.php";
    $.post(url,
        function (data) {
            movies = JSON.parse(data);
            html = '';
            for (var m in movies) {
                html += '<div class="movie" id="' + m + '">' + "<div class=\"img\"><img class=\"poster\"/><img class=\"rating\"/></div><div class=\"description\"><span class=\"tf title\"></span><span class=\"lb summary\"></span></div></div>";
            }
            $('#movies-content').html(html);

            for (var m in movies) {
                $('#' + m + ' .poster').attr('src', movies[m].poster);
                $('#' + m + ' .title').html(movies[m].title);
                $('#' + m + ' .summary').html(movies[m].summary);
                $('#' + m + ' .rating').attr('src', movies[m].rating);
            }

            $('.movie').click(function() {
                window.location.href = 'index.php?p=movie&id='+$(this).attr('id');
                return false;
            });
        }
    );
</script>