<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script>
<?php
require_once(APPPATH . 'assets/js/jquery.lazyload.min.js');
?>
</script>

<script>   
    $(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
    });
</script>