<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class MovieController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for movie
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Movie', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }

       // QueryBuilder
       $movie = $this->modelsManager->createBuilder();
       $movie->columns([
            'm.id AS movieId',
            'f.format_name AS formatName',
            'c.classification_name AS classificationName',
            'g.genre_name AS genreName',
            'd.director_name AS directorName',
            'a.actor_name AS actorName',
            'm.movie_name AS movieName'
       ]);
       $movie->from(['m' => 'Movie']);
       $movie->innerJoin('Format', 'f.id = m.format_id', 'f');
       $movie->innerJoin('Classification', 'c.id = m.classification_id', 'c');
       $movie->innerJoin('Genre', 'g.id = m.genre_id', 'g');
       $movie->innerJoin('Director', 'd.id = m.director_id', 'd');
       $movie->innerJoin('Actor', 'a.id = m.actor_id', 'a');

       // Order
       $movie->orderBy('m.id ASC');

        if (count($movie) == 0) {
            $this->flash->notice("The search did not find any movie");

            $this->dispatcher->forward(array(
                "controller" => "movie",
                "action" => "index"
            ));

            return;
        }

        $paginator = new \Phalcon\Paginator\Adapter\QueryBuilder(array(
            'builder' => $movie,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a movie
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $movie = Movie::findFirstByid($id);
            if (!$movie) {
                $this->flash->error("movie was not found");

                $this->dispatcher->forward(array(
                    'controller' => "movie",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $movie->id;

            $this->tag->setDefault("id", $movie->getId());
            $this->tag->setDefault("format_id", $movie->getFormatId());
            $this->tag->setDefault("classification_id", $movie->getClassificationId());
            $this->tag->setDefault("genre_id", $movie->getGenreId());
            $this->tag->setDefault("director_id", $movie->getDirectorId());
            $this->tag->setDefault("actor_id", $movie->getActorId());
            $this->tag->setDefault("movie_name", $movie->getMovieName());
            
        }
    }

    /**
     * Creates a new movie
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "movie",
                'action' => 'index'
            ));

            return;
        }

        $movie = new Movie();
        $movie->setFormatId($this->request->getPost("format_id"));
        $movie->setClassificationId($this->request->getPost("classification_id"));
        $movie->setGenreId($this->request->getPost("genre_id"));
        $movie->setDirectorId($this->request->getPost("director_id"));
        $movie->setActorId($this->request->getPost("actor_id"));
        $movie->setMovieName($this->request->getPost("movie_name"));
        

        if (!$movie->save()) {
            foreach ($movie->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "movie",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("movie was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "movie",
            'action' => 'index'
        ));
    }

    /**
     * Saves a movie edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "movie",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $movie = Movie::findFirstByid($id);

        if (!$movie) {
            $this->flash->error("movie does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "movie",
                'action' => 'index'
            ));

            return;
        }

        $movie->setFormatId($this->request->getPost("format_id"));
        $movie->setClassificationId($this->request->getPost("classification_id"));
        $movie->setGenreId($this->request->getPost("genre_id"));
        $movie->setDirectorId($this->request->getPost("director_id"));
        $movie->setActorId($this->request->getPost("actor_id"));
        $movie->setMovieName($this->request->getPost("movie_name"));
        

        if (!$movie->save()) {

            foreach ($movie->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "movie",
                'action' => 'edit',
                'params' => array($movie->id)
            ));

            return;
        }

        $this->flash->success("movie was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "movie",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a movie
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $movie = Movie::findFirstByid($id);
        if (!$movie) {
            $this->flash->error("movie was not found");

            $this->dispatcher->forward(array(
                'controller' => "movie",
                'action' => 'index'
            ));

            return;
        }

        try {
            $movie->delete();
        } catch (Exception $e) {
            $this->flash->error("Este registro no se puede eliminar porque existe una integridad de datos.");

            $this->dispatcher->forward(array(
                'controller' => "movie",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("movie was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "movie",
            'action' => "index"
        ));
    }

    /**
     * swapi for movie
     */
    public function swapiAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Movie', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $url ='https://swapi.co/api/films/?format=json';
        $json = file_get_contents($url);
        $content  = json_decode($json,true);

        $ite=0; foreach($content['results'] AS $results) {
        $movie = new Movie();
        $movie->setFormatId(2);
        $movie->setClassificationId(1);
        $movie->setGenreId(5);
        $result = $this->modelsManager->executeQuery("SELECT d.id AS directorId FROM Director d WHERE d.director_name='".$results['director']."'");
        $directorId = 0;
        foreach ($result as $row) {
            $directorId = $row->directorId;
        }
       if($directorId == 0){
            $director = new Director();
            $director->setCountryCode('USA');
            $director->setDirectorName($results['director']);
            $director->save();
            $result = $this->modelsManager->executeQuery("SELECT d.id AS directorId FROM Director d WHERE d.director_name='".$results['director']."'");
            foreach ($result as $row) {
                $directorId = $row->directorId;
            }
           }
        $movie->setDirectorId($directorId);
        $movie->setActorId(4);
        $movie->setMovieName($results['title']);
        $movie->save();
        $content['results'][$ite]['id'] = ($ite+1);
        $release_date = explode("-", $results['release_date']);
        $content['results'][$ite]['release_year'] = $release_date[0];
        $ite++;
        }

        $this->flash->success("SWAPI consumido correctamente. Verifique el registro de pel&iacute;culas.");

        $paginator = new \Phalcon\Paginator\Adapter\NativeArray(array(
            'data' => $content['results'] ,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * select for movie
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT m.id AS movieId, m.movie_name AS movieName FROM Movie m ORDER BY m.movie_name ASC");
        $movie = null;
        foreach ($result as $row) {
            $movie[$row->movieId] = $row->movieName;
        }
        $content = json_encode($movie);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }
}
