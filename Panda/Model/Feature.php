<?php
namespace Panda\Model;

/**
 * Feature Entity
 *
 * @author Dennis Schepers
 */
class Feature extends DB{
    
    // Class variables
    protected $id;
    protected $name;
    protected $categoryName;

    public static function find($id){
        $conn = static::connection();
		
        $sql = "SELECT *"
            . " FROM phone"
            . " WHERE id = '" . $conn->real_escape_string($id) . "'"
            . " LIMIT 1";
		$result = $conn->query($sql);
        
		while($obj = $result->fetch_object()){
			return new Phone($obj);
		}    
    }

    public static function findByCategoryAndName($category, $name){
        $conn = static::connection();
        $sql = "SELECT *"
            . " FROM feature"
            . " WHERE name = '" . $conn->real_escape_string($name) . "'"
            . " AND category_name = '" . $conn->real_escape_string($category)  . "'"
            . " LIMIT 1";
        $result = $conn->query($sql);

        while($obj = $result->fetch_object()){
            return new Feature($obj);
        }
    }

    public static function getAll(){
        $conn = static::connection();
        
        $sql = "SELECT * FROM phone";
        
        // Perform query
        $result = $conn->query($sql);
        
        $phones = array();
        while($obj = $result->fetch_object()){
            $phones[] = new Phone($obj);
        }
        
        return $phones;
    }

    public function save(){
        $conn = static::connection();
        if(!$this->id) {
            $sql = "INSERT INTO feature (name, category_name)"
                . " VALUES ('" . $conn->real_escape_string($this->name) . "', "
                . "'" . $conn->real_escape_string($this->categoryName) . "')";

            // Perform query
            $result = $conn->query($sql);

            // Return the number of affected rows
            $this->id = $conn->insert_id;
            return $this->id;

        } else {
            $sql = "UPDATE feature SET name = '" . $conn->real_escape_string($this->name) . "', category_name = '" . $conn->real_escape_string($this->categoryName) . "'"
                . " WHERE id = " . $this->id;

            // Perform query
            $result = $conn->query($sql);

            // Return the number of affected rows
            return $conn->affected_rows;
        }
    }

    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }


}