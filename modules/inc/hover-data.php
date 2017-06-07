
<style type="text/css">

    /* HOVER STYLES */
    div#pop-up {
        display: none;
        position: absolute;
        width: 280px;
        padding: 10px;
        background: #eeeeee;
        color: #000000;
        border: 1px solid #1a1a1a;
        font-size: 90%;
    }
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        var moveLeft = 20;
        var moveDown = 10;

        $('a#trigger').hover(function (e) {
            $('div#pop-up').show();
        }, function () {
            $('div#pop-up').hide();
        });

        $('a#trigger').mousemove(function (e) {
            $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
        });

    });
</script>
<p>

    <a href="#" id="trigger">this link</a>.
</p>

<!-- HIDDEN / POP-UP DIV -->
<div id="pop-up">
    <h3>Pop-up div Successfully Displayed</h3>
    <p>
        This div only appears when the trigger link is hovered over. Otherwise
        it is hidden from view.
    </p>
</div>