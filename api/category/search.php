<?php
    // Require Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    // Include database and object files
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Initialize db object and connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog category object
    $category = new Category($db);
    
    // get keywords
    $keywords = isset($_GET["s"]) ? $_GET["s"] : "";

    // query category
    $result = $category->search($keywords);
    // get row count
    $num = $result->rowCount();

    // check if any category
    if ($num > 0) {
        // category array
        $cat_arr = array();
        $cat_arr['data'] = array();

        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            extract($row);
            // this will make $row['name'] to
            // just $name only
            $cat_item = array(
                'id' => $id,
                'name' => $name
            );

            // Push to "data"
            array_push($cat_arr['data'], $cat_item);
            // array_push($posts_arr, $post_item);
        }

        // set response code - 200 OK
        http_response_code(200);

        // Turn to JSON and echo
        echo json_encode($cat_arr);

    } else {

        // set response code - 404 Not found
        http_response_code(404);

        // No Category
        echo json_encode(
            array('message' => 'No Category Found')
        );
    }
    

