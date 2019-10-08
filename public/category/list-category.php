<?php

    // Method 1
    $url = "http://localhost/php_rest_myblog/api/category/read.php";
    // $url = "http://soyedotunprojectdemos.000webhostapp.com/php_rest_myblog/api/category/read.php";
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_URL, $url);
    // $result = curl_exec($ch);
    // curl_close($ch);
    // $result = json_decode($result, true); // giving true to json_decode returns array
    // print_r($result);

    // Method 2 - Preferred Method
    $url_json = file_get_contents($url);
    $result = json_decode($url_json, true);
    // print_r($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Frontend for Brad Traversy PHP_REST_MYBLOG API">
    <meta name="keywords" content="HTML5,Bootstrap,cURL,PHP,API">
    <meta name="author" content="Sodiq 'Stark' Oyedotun">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Blog | Category</title>
</head>
<body>
    <div class="container mt-3">
        <h1>Categories</h1>
        <hr>
        <?php foreach($result as $key): ?>
            <ul class="list-group mb-3">
                <?php if(is_array($key) || is_object($key)): ?>
                    <?php foreach($key as $val): ?>
                        <li class="list-group-item list-group-item-primary">Id: <?php echo $val['id']; ?></li>
                        <li class="list-group-item list-group-item-secondary">Name: <?php echo $val['name']; ?></li>
                        <br>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        <?php endforeach; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>