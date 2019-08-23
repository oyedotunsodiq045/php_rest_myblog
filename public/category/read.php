<?php

    // Method 1
    $url = "http://localhost/php_rest_myblog/api/category/read.php";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | Category | Read All</title>
</head>
<body>
    <div class="container">
        <?php foreach($result as $key): ?>
            <ul>
                <?php foreach($key as $val): ?>
                    <li>Id: <?php echo $val[id]; ?></li>
                    <li>Name: <?php echo $val[name]; ?></li>
                    <br>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </div>
</body>
</html>