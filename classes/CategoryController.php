<?php

// Class for handling category-related operations
class CategoryController {

    // Protected property to store the database controller instance
    protected $db;

    // Constructor to initialize the categoryController with a DatabaseController instance
    public function __construct(DatabaseController $db)
    {
        // Assign the provided DatabaseController instance to the db property
        $this->db = $db;
    }

    // Method to retrieve a category record by its ID
    public function get_category_by_id(int $id)
    {
        // SQL query to select a category by its ID
        $sql = "SELECT * FROM categories WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched category record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all category records
    public function get_all_categories()
    {
        // SQL query to select all categories
        $sql = "SELECT * FROM categories";
        // Execute the query and return all fetched records
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Method to update an existing category record
    public function update_category(array $category)
    {
        // SQL query to update a category's information
        $sql = "UPDATE categories SET name = :name WHERE id = :id";

        // Execute the query with the provided updated data
        return $this->db->runSQL($sql, $category)->execute();
    }

    // Method to delete a category record by its ID
    public function delete_category(int $id)
    {
        // SQL query to delete a category by its ID
        $sql = "DELETE FROM categories WHERE id = :id";
        $args = ['id' => $id];

        $sql2 = "DELETE FROM user_categories WHERE category_id = (LAST_INSERT_ID())";
        // Execute the query
        return $this->db->runSQL($sql, $args);
    }

    // Method to register a new category
    public function add_category(array $category)
    {
        try {
            // SQL query to insert a new category record
            $sql = "INSERT INTO categories(name) 
                    VALUES (:name)"; 

            // Execute the query with the provided category data
            $this->db->runSQL($sql, $category);
            return true;

        } catch (PDOException $e) {
            // Handle specific error codes (like duplicate entry)
            if ($e->getCode() == 23000) { // Possible duplicate entry
                return false;
            }
            throw $e;
        }
    }
}

?>
