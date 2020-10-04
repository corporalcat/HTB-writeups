<?php 
    function cekCaptcha()
    {
        if ($_POST['captcha'] === $_SESSION['code'])
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
?>