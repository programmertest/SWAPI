<?php

class Branchoffice extends \Phalcon\Mvc\Model
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
    protected $branchoffice_name;

    /**
     *
     * @var string
     */
    protected $branchoffice_phone;

    /**
     *
     * @var string
     */
    protected $branchoffice_address;

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
     * Method to set the value of field branchoffice_name
     *
     * @param string $branchoffice_name
     * @return $this
     */
    public function setBranchofficeName($branchoffice_name)
    {
        $this->branchoffice_name = $branchoffice_name;

        return $this;
    }

    /**
     * Method to set the value of field branchoffice_phone
     *
     * @param string $branchoffice_phone
     * @return $this
     */
    public function setBranchofficePhone($branchoffice_phone)
    {
        $this->branchoffice_phone = $branchoffice_phone;

        return $this;
    }

    /**
     * Method to set the value of field branchoffice_address
     *
     * @param string $branchoffice_address
     * @return $this
     */
    public function setBranchofficeAddress($branchoffice_address)
    {
        $this->branchoffice_address = $branchoffice_address;

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
     * Returns the value of field branchoffice_name
     *
     * @return string
     */
    public function getBranchofficeName()
    {
        return $this->branchoffice_name;
    }

    /**
     * Returns the value of field branchoffice_phone
     *
     * @return string
     */
    public function getBranchofficePhone()
    {
        return $this->branchoffice_phone;
    }

    /**
     * Returns the value of field branchoffice_address
     *
     * @return string
     */
    public function getBranchofficeAddress()
    {
        return $this->branchoffice_address;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Rent', 'branchoffice_id', array('alias' => 'Rent'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Branchoffice[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Branchoffice
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
            'branchoffice_name' => 'branchoffice_name',
            'branchoffice_phone' => 'branchoffice_phone',
            'branchoffice_address' => 'branchoffice_address'
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'branchoffice';
    }

}
