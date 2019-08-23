<?php
    // show error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    // home page url
    $home_url = "http://localhost/php_rest_myblog/api/";
    
    // page given in URL parameter, default page is one
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    // set number of records per page
    $datas_per_page = 5;
    
    // calculate for the query LIMIT clause
    $from_data_num = ($datas_per_page * $page) - $datas_per_page;
?>