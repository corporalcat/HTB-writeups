<?php
    function getToken()
    {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijlkmnopqrstuvwxyz0123456789";
        $len = 30;

        $randomStr = [];
        for ($i=0;$i<20;$i++)
        {
            $idx = rand(0,61);
            $randomStr[] = $str[$idx];
        }
        $res = implode($randomStr);
        $_SESSION['token'] = hash('sha256', $res); 
    }

    function getToken2($param)
    {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijlkmnopqrstuvwxyz0123456789";
        $len = 30;

        $randomStr = [];
        for ($i=0;$i<20;$i++)
        {
            $idx = rand(0,61);
            $randomStr[] = $str[$idx];
        }
        $res = implode($randomStr);
        $_SESSION['token_'.$param] = hash('sha256', $res);
    }

    function getToken3()
    {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijlkmnopqrstuvwxyz0123456789";
        $len = 30;

        $randomStr = [];
        for ($i=0;$i<20;$i++)
        {
            $idx = rand(0,61);
            $randomStr[] = $str[$idx];
        }
        $res = implode($randomStr);
        $_SESSION['token3'] = hash('sha256', $res); 
    }
?>