<?php

// Class for handling member-related operations
class MemberController {

    // Protected property to store the database controller instance
    protected $db;

    // Constructor to initialize the MemberController with a DatabaseController instance
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
        
        // SQL query to select a member by its ID
        $sql = "SELECT * FROM user_roles WHERE user_id = :user_id AND role_id = :role_id";
        // $args = ['user_id' => $user_id,
        //          'role_id' => $role_id];
        // Execute the query and return the fetched member record
        $result = $this->db->runSQL($sql, $args)->fetch();
        // vardump($args);
        // echo $result;
        return ($result !== false);
    }

    public function get_member_roles(array $args)
    {
        // SQL query to select a member by its ID
        $sql = "SELECT * FROM user_roles WHERE user_id = :user_id AND role_id = :role_id";
        // $args = ['user_id' => $user_id,
        //          'role_id' => $role_id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
        // vardump($args);
        // echo $result;
        // return ($result !== false);
    }

    public function give_member_role(array $args)
    {
        var_dump($args);
        $sql = "INSERT INTO user_roles(user_id, role_id)
        VALUES (:user_id, :role_id);";
        
        // Execute the SQL query with the provided equipment data
        return $this->db->runSQL($sql, $args);
    }

    public function remove_member_role(array $args)
    {
        var_dump($args);
        $sql = "DELETE FROM user_roles WHERE (user_id = :user_id) AND (role_id = :role_id);";
        
        // Execute the SQL query with the provided equipment data
        return $this->db->runSQL($sql, $args);
    }

    // Method to retrieve a member record by its ID
    public function get_member_by_id(int $id)
    {
        // SQL query to select a member by its ID
        $sql = "SELECT * FROM users WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve a member record by email
    public function get_member_by_email(string $email)
    {
        // SQL query to select a member by email
        $sql = "SELECT * FROM users WHERE email = :email";
        $args = ['email' => $email];
        // Execute the query and return the fetched member record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all member records
    public function get_all_members()
    {
        // SQL query to select all members
        $sql = "SELECT * FROM users";
        // Execute the query and return all fetched records
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Method to update an existing member record
    public function update_member(array $member)
    {
        // SQL query to update a member's information
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id";

        // Execute the query with the provided updated data
        return $this->db->runSQL($sql, $member)->execute();
    }

    // Method to delete a member record by its ID
    public function delete_member(int $id)
    {
        // SQL query to delete a member by its ID
        $sql = "DELETE FROM users WHERE id = :id";
        $args = ['id' => $id];

        $sql2 = "DELETE FROM user_roles WHERE user_id = (LAST_INSERT_ID())";
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

            $sql2 = "INSERT INTO user_roles(user_id, role_id)
                     VALUES (LAST_INSERT_ID(), (SELECT id FROM roles WHERE name = 'customer'))";
            
            $this->db->runSQL($sql2);
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