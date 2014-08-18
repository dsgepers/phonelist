<?php
namespace Panda\Model;

/**
 * Phone Entity
 *
 * @author Dennis Schepers
 */
class Phone extends DB{
    
    // Class variables
    protected $_code;
    protected $_vak;
    protected $_periode;
    protected $_aantalStudenten;
    protected $_computerlokaal;
    protected $_surveillant;
    protected $_gebruikerID;
    
    /**
     * Find the Phone by id
     * 
     * @param String $id
     * @return Phone
     */
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
    
    /**
     * Find all the Phones
     * 
     * @return Phone[]
     */
    public static function findAll(){
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
    
    /**
     * Save a Phone object to the database
     * 
     * @return Integer
     */
    public function save(){
        $conn = static::connection();
        $sql = "INSERT INTO phone (code, vak, periode, aantalStudenten, computerlokaal, surveillant, gebruikerID)"
            . " VALUES ('" . $conn->real_escape_string($this->_code) . "', "
            . "'" . $conn->real_escape_string($this->_vak) . "', "
            . "'" . $conn->real_escape_string($this->_periode) . "', "
            . $conn->real_escape_string($this->_aantalStudenten) . ", "
            . $conn->real_escape_string($this->_computerlokaal) . ", "
            . $conn->real_escape_string($this->_surveillant) . ", "
            . $conn->real_escape_string($_SESSION['user']->getID()) . ")";
        
        // Perform query    
        $result = $conn->query($sql);

        // Return the number of affected rows
        return $conn->affected_rows;
    }

}
?>