<?php 
  class Category {
    // DB stuff
    private $conn;
    private $table = 'categories';

    // Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Categories
    public function read() {
      // Create query
      $query = 'SELECT *
                FROM ' . $this->table . '
                ORDER BY created_at 
                DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      // Execute query
      $stmt->execute();
      
      return $stmt;
    }  
    
    // Get Single Category
    public function read_single() {
        // Create query
        $query = 'SELECT id, name 
                  FROM ' . $this->table . ' 
                  WHERE id = ?';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam(1, $this->id);
        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set Properties
        $this->name = $row['name'];
        $this->created_at = $row['created_at'];

    }

    // Create Category
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET name = :name';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        // Bind data
        $stmt->bindParam(':name', $this->name);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n ", $stmt->error);

        return false;
    }

    // Update Category
    public function update() {
        // Create Query
        $query = 'UPDATE ' . $this->table . ' 
                  SET name = :name 
                  WHERE id = :id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));
        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n ", $stmt->error);
    }

    // Delete Category
    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' 
                  WHERE id = :id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        // Bind data
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n ", $stmt->error);
        return false;
    }
  
    // Serach category
    public function search($keywords) {
      // Create query
      $query = 'SELECT * 
                FROM ' . $this->table . '
                WHERE name LIKE ? 
                ORDER BY created_at 
                DESC';
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $keywords = htmlspecialchars(strip_tags($keywords));
      $keywords = "%{$keywords}%";

      // Bind data
      $stmt->bindParam(1, $keywords);

      // Execute query
      $stmt->execute();
         
      return $stmt;
    }

  }