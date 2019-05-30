<?php

//utilizando o autoload, para o carregamento das classes

spl_autoload_register(function($class_name){

    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php"; //encontrar o arquivo na pasta
    if (file_exists($filename)){ //verificar se o arquivo existe na pasta
        require_once($filename);
    }

});  


?>