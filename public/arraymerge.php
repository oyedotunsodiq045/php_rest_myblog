<?php
    
    $post_url = "http://localhost/php_rest_myblog/api/post/read.php";
    $post_url = file_get_contents($post_url);
    $post_url = json_decode($post_url, true);


    $cat_url = "http://localhost/php_rest_myblog/api/category/read.php";
    $cat_url = file_get_contents($cat_url);
    $cat_url = json_decode($cat_url, true);

    
    // Merging arrays together
    $result = array_merge($post_url, $cat_url);
    print_r($result);
    // var_dump($result);
    // print_r($post_url);
    // echo '<br>';
    // echo '<br>';
    // print_r($cat_url);