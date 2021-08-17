<?php

class CustomerManager
{
    private $_db;


    /* -------------------------------- CONSTRUCT ------------------------------- */
    public function __construct($db)
    {
        $this->setDb($db);
    }


    /* --------------------------------- CREATE --------------------------------- */
    public function addCustomer(Customer $c)
    {
        $req = $this->_db->prepare('INSERT INTO `customer`(`firstname`, `lastname`, `email`) VALUES  (:firstname, :lastname, :email)');
        $req->bindValue(':firstname', $c->getFirstname(), PDO::PARAM_STR);
        $req->bindValue(':lastname', $c->getLastname(), PDO::PARAM_STR);
        $req->bindValue(':email', $c->getEmail());

        $req->execute();
    }

    /* --------------------------------- SETTER --------------------------------- */
    public function setDb($db)
    {
        return $this->_db = $db;
    }
}
