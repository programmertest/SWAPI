<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class DirectorController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for director
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Director', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $director = Director::find($parameters);
        if (count($director) == 0) {
            $this->flash->notice("The search did not find any director");

            $this->dispatcher->forward(array(
                "controller" => "director",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $director,
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
     * Edits a director
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $director = Director::findFirstByid($id);
            if (!$director) {
                $this->flash->error("director was not found");

                $this->dispatcher->forward(array(
                    'controller' => "director",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $director->id;

            $this->tag->setDefault("id", $director->getId());
            $this->tag->setDefault("country_code", $director->getCountryCode());
            $this->tag->setDefault("director_name", $director->getDirectorName());
            
        }
    }

    /**
     * Creates a new director
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "director",
                'action' => 'index'
            ));

            return;
        }

        $director = new Director();
        $director->setCountryCode($this->request->getPost("country_code"));
        $director->setDirectorName($this->request->getPost("director_name"));
        

        if (!$director->save()) {
            foreach ($director->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "director",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("director was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "director",
            'action' => 'index'
        ));
    }

    /**
     * Saves a director edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "director",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $director = Director::findFirstByid($id);

        if (!$director) {
            $this->flash->error("director does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "director",
                'action' => 'index'
            ));

            return;
        }

        $director->setCountryCode($this->request->getPost("country_code"));
        $director->setDirectorName($this->request->getPost("director_name"));
        

        if (!$director->save()) {

            foreach ($director->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "director",
                'action' => 'edit',
                'params' => array($director->id)
            ));

            return;
        }

        $this->flash->success("director was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "director",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a director
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $director = Director::findFirstByid($id);
        if (!$director) {
            $this->flash->error("director was not found");

            $this->dispatcher->forward(array(
                'controller' => "director",
                'action' => 'index'
            ));

            return;
        }

        try {
            $director->delete();
        } catch (Exception $e) {
            $this->flash->error("Este registro no se puede eliminar porque existe una integridad de datos.");

            $this->dispatcher->forward(array(
                'controller' => "director",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("director was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "director",
            'action' => "index"
        ));
    }

    /**
     * select for director
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT d.id AS directorId, d.director_name AS directorName FROM Director d ORDER BY d.director_name ASC");
        $director = null;
        foreach ($result as $row) {
            $director[$row->directorId] = $row->directorName;
        }
        $content = json_encode($director);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }

}
