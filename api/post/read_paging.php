<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    // include database and object files
    include_once '../../config/Core.php';
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';
    include_once '../../shared/Utilities.php';
    
    // utilities
    $utilities = new Utilities();
    
    // instantiate database and product object
    $database = new Database();
    $db = $database->connect();
    
    // initialize object
    $post = new Post($db);
    
    // query posts
    $stmt = $post->read_paging($from_data_num, $datas_per_page);
    $num = $stmt->rowCount();
    
    // check if more than 0 record found
    if ($num > 0) {
    
        // posts array
        $posts_arr              =    array();
        $posts_arr["data"]      =    array();
        $posts_arr["paging"]    =    array();
    
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
 
            $post_item = array(
              'id' => $id,
              'title' => $title,
              'body' => html_entity_decode($body),
              'author' => $author,
              'category_id' => $category_id,
              'category_name' => $category_name
            );
    
            array_push($posts_arr["data"], $post_item);
        }
    
        // include paging
        $total_rows            =    $post->count();
        $page_url              =    "{$home_url}post/read_paging.php?";
        $paging                =    $utilities->get_paging($page, $total_rows, $datas_per_page, $page_url);
        $posts_arr["paging"]   =    $paging;
    
        // set response code - 200 OK
        http_response_code(200);
    
        // make it json format
        echo json_encode($posts_arr);
    } else {
    
        // set response code - 404 Not found
        http_response_code(404);
    
        // tell the user posts does not exist
        echo json_encode(
            array("message" => "No posts found.")
        );
    }
?>