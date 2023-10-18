<?php
    $_SESSION=array();
    session_destroy();
    echo '<script>window.location="../login"</script>';