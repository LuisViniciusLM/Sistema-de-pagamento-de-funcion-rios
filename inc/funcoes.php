<?php

if(function_exists('alert') == false)
{
    function alert($msg)
    {
        echo "<script language ='JavaScript'>";
        echo "alert('$msg');";
        echo"</script>";
    }
}

if (function_exists('salvar_log') ==false) 
{
    function salvar_log($sql, $nome = '1.txt')
    {
        $nome = $_SERVER['DOCUMENT_ROOT'].'logs/'.$nome;
        $file = fopen($nome, 'a+');
        fwrite($file, $sql.PHP_EOL);
        fclose($file);
    }
}