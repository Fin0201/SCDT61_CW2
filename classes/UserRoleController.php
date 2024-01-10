<?php

// Class for handling member-related operations
class UserRoleController {

    // Protected property to store the database controller instance
    protected $db;

    // Constructor to initialize the MemberController with a DatabaseController instance
    public function __construct(DatabaseController $db)
    {
        // Assign the provided DatabaseController instance to the db property
        $this->db = $db;
    }

    public function get_members_by_role_id(int $role_id)
    {
        // SQL query to select a member by its ID
        $sql = "SELECT * FROM user_roles WHERE role_id = :role_id";
        $args = ['role_id' => $role_id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    public function get_roles_by_member_id(int $user_id)
    {
        // SQL query to select a member by its ID
        $sql = "SELECT * FROM user_roles WHERE user_id = :user_id";
        $args = ['user_id' => $user_id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all user role records
    public function get_all_user_roles()
    {
        // SQL query to select all members
        $sql = "SELECT * FROM user_roles";
        // Execute the query and return all fetched records
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Method to update an existing member record
    public function update_member(array $member)
    {
        // SQL query to update a member's information
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id";
        // Execute the query with the provided updated data
        return $this->db->runSQL($sql, $member);
    }

    // Method to delete a member record by its ID
    public function delete_member(int $id)
    {
        // SQL query to delete a member by its ID
        $sql = "DELETE FROM users WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query
        return $this->db->runSQL($sql, $args);
    }

    // Method to register a new member
    public function register_member(array $member)
    {
        try {
            // SQL query to insert a new member record
            $sql = "INSERT INTO users(firstname, lastname, email, password) 
                    VALUES (:firstname, :lastname, :email, :password)"; 

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

    // Method to validate member login
    public function login_member(string $email, string $password)
    {
        // Retrieve the member by email
        $member = $this->get_member_by_email($email);

        // If member exists, verify the password
        if ($member) {
            $auth = password_verify($password,  $member['password']);
            // Return member data if authentication is successful, otherwise return false
            return $auth ? $member : false;
        }
        return false;
    }


}

?>
