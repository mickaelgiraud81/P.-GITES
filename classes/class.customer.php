<?php
class Customer
{

    private $_idCustomer;
    private $_firstname;
    private $_lastname;
    private $_email;


    /* -------------------------------- CONSTRUCT ------------------------------- */
    public function __construct(array $data)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }


    /* --------------------------------- HYDRATE -------------------------------- */
    public function hydrate(array $element)
    {
        foreach ($element as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    /* --------------------------------- GETTER --------------------------------- */
    public function getIdCustomer()
    {
        return $this->_idCustomer;
    }

    public function getFirstname()
    {
        return $this->_firstname;
    }

    public function getLastname()
    {
        return $this->_lastname;
    }

    public function getEmail()
    {
        return $this->_email;
    }


    /* --------------------------------- SETTER --------------------------------- */
    public function setIdCustomer($idCustomer)
    {
        $this->_idCustomer = $idCustomer;
    }

    public function setFirstname($firstname)
    {
        $this->_firsname = $firstname;
    }
    public function setLastname($lastname)
    {
        $this->_lastname = $lastname;
    }
    public function setEmail($email)
    {
        $this->_email = $email;
    }
}
