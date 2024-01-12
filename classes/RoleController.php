<?php

// Class for handling member-related operations
class RoleController {

    // Protected property to store the database controller instance
    protected $db;

    // Constructor to initialize the MemberController with a DatabaseController instance
    public function __construct(DatabaseController $db)
    {
        // Assign the provided DatabaseController instance to the db property
        $this->db = $db;
    }

    // Method to retrieve a member record by its ID
    public function get_role_by_id(int $id)
    {
        // SQL query to select a member by its ID
        $sql = "SELECT * FROM roles WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all member records
    public function get_all_roles()
    {
        // SQL query to select all members
        $sql = "SELECT * FROM roles";
        // Execute the query and return all fetched records
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Method to update an existing member record
    public function update_role(array $role)
    {
        // SQL query to update a member's information
        $sql = "UPDATE roles SET name = :name WHERE id = :id";

        // Execute the query with the provided updated data
        return $this->db->runSQL($sql, $role)->execute();
    }

    // Method to delete a member record by its ID
    public function delete_role(int $id)
    {
        // SQL query to delete a member by its ID
        $sql = "DELETE FROM roels WHERE id = :id";
        $args = ['id' => $id];

        $sql2 = "DELETE FROM user_roles WHERE role_id = (LAST_INSERT_ID())";
        // Execute the query
        return $this->db->runSQL($sql, $args);
    }

    // Method to register a new member
    public function add_role(array $member)
    {
        try {
            // SQL query to insert a new member record
            $sql = "INSERT INTO roles(name) 
                    VALUES (:name)"; 

            // Execute the query with the provided member data
            $this->db->runSQL($sql, $member);
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
