<?php

class Rent extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $branchoffice_id;

    /**
     *
     * @var integer
     */
    protected $client_id;

    /**
     *
     * @var integer
     */
    protected $movie_id;

    /**
     *
     * @var string
     */
    protected $rent_stardate;

    /**
     *
     * @var string
     */
    protected $rent_returndate;

    /**
     *
     * @var string
     */
    protected $rent_value;

    /**
     *
     * @var string
     */
    protected $rent_amount;

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
     * Method to set the value of field branchoffice_id
     *
     * @param integer $branchoffice_id
     * @return $this
     */
    public function setBranchofficeId($branchoffice_id)
    {
        $this->branchoffice_id = $branchoffice_id;

        return $this;
    }

    /**
     * Method to set the value of field client_id
     *
     * @param integer $client_id
     * @return $this
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * Method to set the value of field movie_id
     *
     * @param integer $movie_id
     * @return $this
     */
    public function setMovieId($movie_id)
    {
        $this->movie_id = $movie_id;

        return $this;
    }

    /**
     * Method to set the value of field rent_stardate
     *
     * @param string $rent_stardate
     * @return $this
     */
    public function setRentStardate($rent_stardate)
    {
        $this->rent_stardate = $rent_stardate;

        return $this;
    }

    /**
     * Method to set the value of field rent_returndate
     *
     * @param string $rent_returndate
     * @return $this
     */
    public function setRentReturndate($rent_returndate)
    {
        $this->rent_returndate = $rent_returndate;

        return $this;
    }

    /**
     * Method to set the value of field rent_value
     *
     * @param string $rent_value
     * @return $this
     */
    public function setRentValue($rent_value)
    {
        $this->rent_value = $rent_value;

        return $this;
    }

    /**
     * Method to set the value of field rent_amount
     *
     * @param string $rent_amount
     * @return $this
     */
    public function setRentAmount($rent_amount)
    {
        $this->rent_amount = $rent_amount;

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
     * Returns the value of field branchoffice_id
     *
     * @return integer
     */
    public function getBranchofficeId()
    {
        return $this->branchoffice_id;
    }

    /**
     * Returns the value of field client_id
     *
     * @return integer
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Returns the value of field movie_id
     *
     * @return integer
     */
    public function getMovieId()
    {
        return $this->movie_id;
    }

    /**
     * Returns the value of field rent_stardate
     *
     * @return string
     */
    public function getRentStardate()
    {
        return $this->rent_stardate;
    }

    /**
     * Returns the value of field rent_returndate
     *
     * @return string
     */
    public function getRentReturndate()
    {
        return $this->rent_returndate;
    }

    /**
     * Returns the value of field rent_value
     *
     * @return string
     */
    public function getRentValue()
    {
        return $this->rent_value;
    }

    /**
     * Returns the value of field rent_amount
     *
     * @return string
     */
    public function getRentAmount()
    {
        return $this->rent_amount;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('branchoffice_id', 'Branchoffice', 'id', array('alias' => 'Branchoffice'));
        $this->belongsTo('client_id', 'Client', 'id', array('alias' => 'Client'));
        $this->belongsTo('movie_id', 'Movie', 'id', array('alias' => 'Movie'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Rent[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Rent
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
            'branchoffice_id' => 'branchoffice_id',
            'client_id' => 'client_id',
            'movie_id' => 'movie_id',
            'rent_stardate' => 'rent_stardate',
            'rent_returndate' => 'rent_returndate',
            'rent_value' => 'rent_value',
            'rent_amount' => 'rent_amount'
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rent';
    }

}
