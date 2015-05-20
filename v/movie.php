<a class="back" href="index.php?p=movies">
    < Back to <span class="yellow">Movies</span> page
</a>
<div id="<?=$_GET['id']?>">
</div>

<script type="application/javascript">
    url = "http://jupiter.csit.rmit.edu.au/~e54061/wp/movie-service.php";
    $.post(url,
        function (data) {
            movies = JSON.parse(data);
            m = '<?=$_GET['id']?>';

            html = '<video controls><source class="trailer" type="video/mp4"></video>'+
                '<div class="left"><div class="bigyellow tit"><img class="rating" width="150"/></div>'+
                '<div class="description"></div><div class="label">Session</div>'+
                ' <div class="cont"><select></select></div>'+
                '<div id="bt-buy-ticket" class="button">Buy Ticket</div>';

            $('#'+m).html(html);

            $('#' + m + ' video').attr('src', movies[m].trailer);
            $('#' + m + ' .tit').html(movies[m].title);
            $('#' + m + ' .description').html(movies[m].description);
            $('#' + m + ' .rating').attr('src', movies[m].rating);

            select = '<select>';
            for (s in movies[m].sessions) {
                select += '<option class="p1" value="'+s+' '+movies[m].sessions[s]+'">'+s+' '+movies[m].sessions[s]+'</option>';
            }
            select += '</select>';

            $('#'+m+' select').html(select);

            $('#'+m+' .button').click(function() {
                val = $('#'+m+' option:selected').text().split(" ");
                day = val[0];
                time = val[1];

                window.location.href = 'index.php?p=select-ticket&id='+m+
                    '&name='+movies[m].title+
                    '&day='+day+
                    '&time='+time;
                return false;
            });
        }
    );
</script>