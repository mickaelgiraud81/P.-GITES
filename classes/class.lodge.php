<?php
class Lodge
{
    private $_idlodge;
    private $_lodgename;
    private $_bedroom;
    private $_bathroom;
    private $_price;
    private $_arrival;
    private $_departure;
    private $_location;
    private $_category;
    private $_specificity;
    private $_image;


    /* --------------------------------- HYDRATE -------------------------------- */
    public function hydrate(array $elements)
    {
        foreach ($elements as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    /* -------------------------------- CONSTRUCT ------------------------------- */
    public function __construct(array $data)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /* --------------------------------- GETTER --------------------------------- */
    public function getIdlodge()
    {
        return $this->_idlodge;
    }   

    public function getLodgename()
    {
        return $this->_lodgename;
    }

    public function getBedroom()
    {
        return $this->_bedroom;
    }

    public function getBathroom()
    {
        return $this->_bathroom;
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function getArrival()
    {
        return $this->_arrival;
    }

    public function getDeparture()
    {
        return $this->_departure;
    }

    public function getLocation()
    {
        return $this->_location;
    }

    public function getCategory()
    {
        return $this->_category;
    }

    public function getSpecificity()
    {
        return $this->_specificity;
    }

    public function getImage()
    {
        return $this->_image;
    }


    /* --------------------------------- SETTER --------------------------------- */
    public function setIdlodge(int $idlodge)
    {
        $this->_idlodge = $idlodge;
    }

    public function setLodgename($lodgename)
    {
        $this->_lodgename = $lodgename;
    }
    public function setBedroom(int $bedroom)
    {
        $this->_bedroom = $bedroom;
    }
    public function setBathroom(int $bathroom)
    {
        $this->_bathroom = $bathroom;
    }
    public function setPrice(float $price)
    {
        $this->_price = $price;
    }
    public function setArrival($arrival)
    {
        $this->_arrival = $arrival;
    }
    public function setDeparture($departure)
    {
        $this->_departure = $departure;
    }
    public function setLocation($location)
    {
        $this->_location = $location;
    }
    public function setCategory($category)
    {
        $this->_category = $category;
    }
    public function setSpecificity($specificity)
    {
        $this->_specificity = $specificity;
    }
    public function setImage($image)
    {
        $this->_image = $image;
    }
}
