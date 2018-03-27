<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class GenreController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for genre
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Genre', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $genre = Genre::find($parameters);
        if (count($genre) == 0) {
            $this->flash->notice("The search did not find any genre");

            $this->dispatcher->forward(array(
                "controller" => "genre",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $genre,
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
     * Edits a genre
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $genre = Genre::findFirstByid($id);
            if (!$genre) {
                $this->flash->error("genre was not found");

                $this->dispatcher->forward(array(
                    'controller' => "genre",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $genre->id;

            $this->tag->setDefault("id", $genre->getId());
            $this->tag->setDefault("genre_name", $genre->getGenreName());
            
        }
    }

    /**
     * Creates a new genre
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "genre",
                'action' => 'index'
            ));

            return;
        }

        $genre = new Genre();
        $genre->setGenreName($this->request->getPost("genre_name"));
        

        if (!$genre->save()) {
            foreach ($genre->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "genre",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("genre was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "genre",
            'action' => 'index'
        ));
    }

    /**
     * Saves a genre edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "genre",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $genre = Genre::findFirstByid($id);

        if (!$genre) {
            $this->flash->error("genre does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "genre",
                'action' => 'index'
            ));

            return;
        }

        $genre->setGenreName($this->request->getPost("genre_name"));
        

        if (!$genre->save()) {

            foreach ($genre->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "genre",
                'action' => 'edit',
                'params' => array($genre->id)
            ));

            return;
        }

        $this->flash->success("genre was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "genre",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a genre
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $genre = Genre::findFirstByid($id);
        if (!$genre) {
            $this->flash->error("genre was not found");

            $this->dispatcher->forward(array(
                'controller' => "genre",
                'action' => 'index'
            ));

            return;
        }

        try {
            $genre->delete();
        } catch (Exception $e) {
            $this->flash->error("Este registro no se puede eliminar porque existe una integridad de datos.");

            $this->dispatcher->forward(array(
                'controller' => "genre",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("genre was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "genre",
            'action' => "index"
        ));
    }

    /**
     * select for genre
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT g.id AS genreId, g.genre_name AS genreName FROM Genre g ORDER BY g.genre_name ASC");
        $genre = null;
        foreach ($result as $row) {
            $genre[$row->genreId] = $row->genreName;
        }
        $content = json_encode($genre);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }

}
