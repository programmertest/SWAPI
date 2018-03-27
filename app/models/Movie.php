<?php

class Movie extends \Phalcon\Mvc\Model
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
    protected $format_id;

    /**
     *
     * @var integer
     */
    protected $classification_id;

    /**
     *
     * @var integer
     */
    protected $genre_id;

    /**
     *
     * @var integer
     */
    protected $director_id;

    /**
     *
     * @var integer
     */
    protected $actor_id;

    /**
     *
     * @var string
     */
    protected $movie_name;

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
     * Method to set the value of field format_id
     *
     * @param integer $format_id
     * @return $this
     */
    public function setFormatId($format_id)
    {
        $this->format_id = $format_id;

        return $this;
    }

    /**
     * Method to set the value of field classification_id
     *
     * @param integer $classification_id
     * @return $this
     */
    public function setClassificationId($classification_id)
    {
        $this->classification_id = $classification_id;

        return $this;
    }

    /**
     * Method to set the value of field genre_id
     *
     * @param integer $genre_id
     * @return $this
     */
    public function setGenreId($genre_id)
    {
        $this->genre_id = $genre_id;

        return $this;
    }

    /**
     * Method to set the value of field director_id
     *
     * @param integer $director_id
     * @return $this
     */
    public function setDirectorId($director_id)
    {
        $this->director_id = $director_id;

        return $this;
    }

    /**
     * Method to set the value of field actor_id
     *
     * @param integer $actor_id
     * @return $this
     */
    public function setActorId($actor_id)
    {
        $this->actor_id = $actor_id;

        return $this;
    }

    /**
     * Method to set the value of field movie_name
     *
     * @param string $movie_name
     * @return $this
     */
    public function setMovieName($movie_name)
    {
        $this->movie_name = $movie_name;

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
     * Returns the value of field format_id
     *
     * @return integer
     */
    public function getFormatId()
    {
        return $this->format_id;
    }

    /**
     * Returns the value of field classification_id
     *
     * @return integer
     */
    public function getClassificationId()
    {
        return $this->classification_id;
    }

    /**
     * Returns the value of field genre_id
     *
     * @return integer
     */
    public function getGenreId()
    {
        return $this->genre_id;
    }

    /**
     * Returns the value of field director_id
     *
     * @return integer
     */
    public function getDirectorId()
    {
        return $this->director_id;
    }

    /**
     * Returns the value of field actor_id
     *
     * @return integer
     */
    public function getActorId()
    {
        return $this->actor_id;
    }

    /**
     * Returns the value of field movie_name
     *
     * @return string
     */
    public function getMovieName()
    {
        return $this->movie_name;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Rent', 'movie_id', array('alias' => 'Rent'));
        $this->belongsTo('actor_id', 'Actor', 'id', array('alias' => 'Actor'));
        $this->belongsTo('classification_id', 'Classification', 'id', array('alias' => 'Classification'));
        $this->belongsTo('director_id', 'Director', 'id', array('alias' => 'Director'));
        $this->belongsTo('format_id', 'Format', 'id', array('alias' => 'Format'));
        $this->belongsTo('genre_id', 'Genre', 'id', array('alias' => 'Genre'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Movie[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Movie
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
            'format_id' => 'format_id',
            'classification_id' => 'classification_id',
            'genre_id' => 'genre_id',
            'director_id' => 'director_id',
            'actor_id' => 'actor_id',
            'movie_name' => 'movie_name'
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'movie';
    }

}
