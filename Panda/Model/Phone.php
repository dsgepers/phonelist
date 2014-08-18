<?php
namespace Panda\Model;

/**
 * Phone Entity
 *
 * @author Dennis Schepers
 */
class Phone extends DB{
    
    // Class variables
    protected $id;
    protected $internalId;
    protected $price;
    protected $brand;
    protected $color;
    protected $title;
    protected $ean;

    protected $Features;
    
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
     * Get all the Phones
     * 
     * @return Phone[]
     */
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

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setInternalId($internalId)
    {
        $this->internalId = $internalId;
    }

    public function getInternalId()
    {
        return $this->internalId;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setFeatures(array $Features)
    {
        $this->Features = $Features;
    }

    public function getFeatures()
    {
        return $this->Features;
    }


}