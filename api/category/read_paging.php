<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    // include database and object files
    include_once '../../config/Core.php';
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';
    include_once '../../shared/Utilities.php';
    
    // utilities
    $utilities = new Utilities();
    
    // instantiate database and category object
    $database = new Database();
    $db = $database->connect();
    
    // initialize object
    $category = new Category($db);
    
    // query categories
    $stmt = $category->read_paging($from_data_num, $datas_per_page);
    $num = $stmt->rowCount();
    
    // check if more than 0 record found
    if ($num > 0) {
    
        // category array
        $cat_arr              =    array();
        $cat_arr["data"]      =    array();
        $cat_arr["paging"]    =    array();
    
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
 
            $cat_item = array(
              'id' => $id,
              'name' => $name,
            );
    
            array_push($cat_arr["data"], $cat_item);
        }
    
        // include paging
        $total_rows          =    $category->count();
        $page_url            =    "{$home_url}category/read_paging.php?";
        $paging              =    $utilities->get_paging($page, $total_rows, $datas_per_page, $page_url);
        $cat_arr["paging"]   =    $paging;
    
        // set response code - 200 OK
        http_response_code(200);
    
        // make it json format
        echo json_encode(
            array(
                'status' => true,
                'message' => 'Categories Paging',
                'data' => $cat_arr['data']
            )
        );
    } else {
    
        // set response code - 404 Not found
        http_response_code(404);
    
        // tell the user category does not exist
        echo json_encode(
            array(
                'status' => false,
                "message" => "No categories found."
            )
        );
    }
?>