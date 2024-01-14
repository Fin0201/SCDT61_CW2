<?php

// Class for handling supplier-related operations
class SupplierController {

    // Protected property to store the database controller instance
    protected $db;

    // Constructor to initialize the supplierController with a DatabaseController instance
    public function __construct(DatabaseController $db)
    {
        // Assign the provided DatabaseController instance to the db property
        $this->db = $db;
    }

    // Method to retrieve a supplier record by its ID
    public function get_supplier_by_id(int $id)
    {
        // SQL query to select a supplier by its ID
        $sql = "SELECT * FROM suppliers WHERE id = :id";
        $args = ['id' => $id];
        // Execute the query and return the fetched supplier record
        return $this->db->runSQL($sql, $args)->fetch();
    }

    // Method to retrieve all supplier records
    public function get_all_suppliers()
    {
        // SQL query to select all suppliers
        $sql = "SELECT * FROM suppliers";
        // Execute the query and return all fetched records
        return $this->db->runSQL($sql)->fetchAll();
    }

    // Method to update an existing supplier record
    public function update_supplier(array $supplier)
    {
        // SQL query to update a supplier's information
        $sql = "UPDATE suppliers SET name = :name, email = :email, phoneNumber = :phoneNumber WHERE id = :id";

        // Execute the query with the provided updated data
        return $this->db->runSQL($sql, $supplier)->execute();
    }

    // Method to delete a supplier record by its ID
    public function delete_supplier(int $id)
    {
        // SQL query to delete a supplier by its ID
        $sql = "DELETE FROM suppliers WHERE id = :id";
        $args = ['id' => $id];

        $sql2 = "DELETE FROM user_suppliers WHERE supplier_id = (LAST_INSERT_ID())";
        // Execute the query
        return $this->db->runSQL($sql, $args);
    }

    // Method to register a new supplier
    public function add_supplier(array $supplier)
    {
        try {
            // SQL query to insert a new supplier record
            $sql = "INSERT INTO suppliers(name, email, phoneNumber) 
                    VALUES (:name, :email, :phoneNumber)"; 

            // Execute the query with the provided supplier data
            $this->db->runSQL($sql, $supplier);
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
