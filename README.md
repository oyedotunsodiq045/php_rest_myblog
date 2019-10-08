# PHP REST API

> This is a simple PHP REST API from scratch with no framework.

## Quick Start

Import the myblog.sql file, change the params in the config/Database.php file to your own

## App Info

## Testing

### CATEGORIES

CREATE A CATEGORY
METHOD - POST
URL - http://soyedotunprojectdemos.000webhostapp.com/php_rest_myblog/api/category/create.php
SAMPLE REQUEST
{
    "name": "Job"
}
SAMPLE RESPONSE
{
    "status": true,
    "message": "Category Created"
}


GET ALL CATEGORIES
METHOD - GET
URL - http://soyedotunprojectdemos.000webhostapp.com/php_rest_myblog/api/category/read.php
SAMPLE RESPONSE
{
    "status": true,
    "message": "Categories Found",
    "data": [
        {
            "id": "7",
            "name": "Insurance"
        },
        {
            "id": "6",
            "name": "Department"
        },
        {
            "id": "1",
            "name": "Technology"
        },
        {
            "id": "2",
            "name": "Gaming"
        },
        {
            "id": "3",
            "name": "Auto"
        },
        {
            "id": "4",
            "name": "Entertainment"
        },
        {
            "id": "5",
            "name": "Books"
        }
    ]
}


GET A CATEGORY
METHOD - GET
URL - http://soyedotunprojectdemos.000webhostapp.com/php_rest_myblog/api/category/read_single.php?id=1
SAMPLE RESPONSE
{
    "status": true,
    "message": "Category Found",
    "data": {
        "id": "1",
        "name": "Technology"
    }
}


UPDATE A CATEGORY
METHOD - PUT
URL - http://soyedotunprojectdemos.000webhostapp.com/php_rest_myblog/api/category/update.php
HEADER - KEY - Content-Type
	 VALUE - application/json
SAMPLE REQUEST
{
    "id": "7",
    "name": "Insurtech"
}
SAMPLE RESPONSE
{
    "status": true,
    "message": "Category Updated"
}


DELETE A CATEGORY
METHOD - DELETE
URL - http://soyedotunprojectdemos.000webhostapp.com/php_rest_myblog/api/category/delete.php
HEADER - KEY - Authorization
	 VALUE - application/json
SAMPLE REQUEST
{
    "id": "7"
}
SAMPLE RESPONSE
{
    "status": true,
    "message": "Category Deleted"
}


SEARCH BLOG CATEGORY
METHOD - GET
URL - http://soyedotunprojectdemos.000webhostapp.com/php_rest_myblog/api/category/search.php?s=tech
SAMPLE RESPONSE
{
    "status": true,
    "message": "Searched Category Found",
    "data": [
        {
            "id": "1",
            "name": "Technology"
        }
    ]
}

GET ALL CATEGORY - PAGING
METHOD - GET
URL - http://soyedotunprojectdemos.000webhostapp.com/php_rest_myblog/api/category/read_paging.php
SAMPLE RESPONSE
{
    "status": true,
    "message": "Categories Paging",
    "data": [
        {
            "id": "6",
            "name": "Department"
        },
        {
            "id": "1",
            "name": "Technology"
        },
        {
            "id": "2",
            "name": "Gaming"
        },
        {
            "id": "3",
            "name": "Auto"
        },
        {
            "id": "4",
            "name": "Entertainment"
        }
    ]
}

### Author

Brad Traversy
[Traversy Media](http://www.traversymedia.com)

Sodiq Oyedotun
[Soyedotun Media](http://oyedotunsodiq.000webhostapp.com/)
[Soyedotun Media](http://mba-ies-fps.000webhostapp.com/sodiqoyedotun.com/index.html)

### Version

1.0.0

### License

This project is licensed under the MIT License
