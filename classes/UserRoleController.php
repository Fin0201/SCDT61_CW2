<?php

// Class for handling user role-related operations
class UserRoleController {

    // Protected property to store the database controller instance
    protected $db;

    // Constructor to initialize the UserRoleController with a DatabaseController instance
    public function __construct(DatabaseController $db)
    {
        // Assign the provided DatabaseController instance to the db property
        $this->db = $db;
    }

    // Method to retrieve a member record by its ID
    public function get_role_by_user_id(int $id)
    {
        // SQL query to select a member by its ID
        $sql = "SELECT role_id FROM user_roles WHERE user_id = :user_id";
        $args = ['user_id' => $id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function check_user_has_role(array $args)
    {
        $sql = "SELECT * FROM user_roles WHERE user_id = :user_id AND role_id = :role_id";
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_member_roles(array $args)
    {
        $sql = "SELECT * FROM user_roles WHERE user_id = :user_id AND role_id = :role_id";

        // Execute the query and return the fetched member roles record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function give_member_role(array $args)
    {
        try {
            $sql = "INSERT INTO user_roles(user_id, role_id)
            VALUES (:user_id, :role_id);";
            
            // Execute the SQL query with the provided equipment data
            return $this->db->runSQL($sql, $args);
        } catch (PDOException $e) {
            // Handle specific error codes (like duplicate entry)
            if ($e->getCode() == 23000) { // Possible duplicate entry
                return false;
            }
            throw $e;
        }
    }

    public function remove_member_role(array $args)
    {
        $sql = "DELETE FROM user_roles WHERE (user_id = :user_id) AND (role_id = :role_id);";
        
        // Execute the SQL query with the provided equipment data
        return $this->db->runSQL($sql, $args);
    }
}

?>
