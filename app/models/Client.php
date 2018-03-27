<?php

class Client extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $client_name;

    /**
     *
     * @var string
     */
    protected $client_surname;

    /**
     *
     * @var string
     */
    protected $client_phone;

    /**
     *
     * @var string
     */
    protected $client_address;

    /**
     *
     * @var string
     */
    protected $client_mobile;

    /**
     *
     * @var string
     */
    protected $client_email;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field client_name
     *
     * @param string $client_name
     * @return $this
     */
    public function setClientName($client_name)
    {
        $this->client_name = $client_name;

        return $this;
    }

    /**
     * Method to set the value of field client_surname
     *
     * @param string $client_surname
     * @return $this
     */
    public function setClientSurname($client_surname)
    {
        $this->client_surname = $client_surname;

        return $this;
    }

    /**
     * Method to set the value of field client_phone
     *
     * @param string $client_phone
     * @return $this
     */
    public function setClientPhone($client_phone)
    {
        $this->client_phone = $client_phone;

        return $this;
    }

    /**
     * Method to set the value of field client_address
     *
     * @param string $client_address
     * @return $this
     */
    public function setClientAddress($client_address)
    {
        $this->client_address = $client_address;

        return $this;
    }

    /**
     * Method to set the value of field client_mobile
     *
     * @param string $client_mobile
     * @return $this
     */
    public function setClientMobile($client_mobile)
    {
        $this->client_mobile = $client_mobile;

        return $this;
    }

    /**
     * Method to set the value of field client_email
     *
     * @param string $client_email
     * @return $this
     */
    public function setClientEmail($client_email)
    {
        $this->client_email = $client_email;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field client_name
     *
     * @return string
     */
    public function getClientName()
    {
        return $this->client_name;
    }

    /**
     * Returns the value of field client_surname
     *
     * @return string
     */
    public function getClientSurname()
    {
        return $this->client_surname;
    }

    /**
     * Returns the value of field client_phone
     *
     * @return string
     */
    public function getClientPhone()
    {
        return $this->client_phone;
    }

    /**
     * Returns the value of field client_address
     *
     * @return string
     */
    public function getClientAddress()
    {
        return $this->client_address;
    }

    /**
     * Returns the value of field client_mobile
     *
     * @return string
     */
    public function getClientMobile()
    {
        return $this->client_mobile;
    }

    /**
     * Returns the value of field client_email
     *
     * @return string
     */
    public function getClientEmail()
    {
        return $this->client_email;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Rent', 'client_id', array('alias' => 'Rent'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Client[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Client
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return array(
            'id' => 'id',
            'client_name' => 'client_name',
            'client_surname' => 'client_surname',
            'client_phone' => 'client_phone',
            'client_address' => 'client_address',
            'client_mobile' => 'client_mobile',
            'client_email' => 'client_email'
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'client';
    }

}
