<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ActorController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for actor
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Actor', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $actor = Actor::find($parameters);
        if (count($actor) == 0) {
            $this->flash->notice("The search did not find any actor");

            $this->dispatcher->forward(array(
                "controller" => "actor",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $actor,
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
     * Edits a actor
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $actor = Actor::findFirstByid($id);
            if (!$actor) {
                $this->flash->error("actor was not found");

                $this->dispatcher->forward(array(
                    'controller' => "actor",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $actor->id;

            $this->tag->setDefault("id", $actor->getId());
            $this->tag->setDefault("country_code", $actor->getCountryCode());
            $this->tag->setDefault("actor_name", $actor->getActorName());

        }
    }

    /**
     * Creates a new actor
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "actor",
                'action' => 'index'
            ));

            return;
        }

        $actor = new Actor();
        $actor->setCountryCode($this->request->getPost("country_code"));
        $actor->setActorName($this->request->getPost("actor_name"));


        if (!$actor->save()) {
            foreach ($actor->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "actor",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("actor was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "actor",
            'action' => 'index'
        ));
    }

    /**
     * Saves a actor edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "actor",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $actor = Actor::findFirstByid($id);

        if (!$actor) {
            $this->flash->error("actor does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "actor",
                'action' => 'index'
            ));

            return;
        }

        $actor->setCountryCode($this->request->getPost("country_code"));
        $actor->setActorName($this->request->getPost("actor_name"));


        if (!$actor->save()) {

            foreach ($actor->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "actor",
                'action' => 'edit',
                'params' => array($actor->id)
            ));

            return;
        }

        $this->flash->success("actor was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "actor",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a actor
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $actor = Actor::findFirstByid($id);
        if (!$actor) {
            $this->flash->error("actor was not found");

            $this->dispatcher->forward(array(
                'controller' => "actor",
                'action' => 'index'
            ));

            return;
        }

        try {
            $actor->delete();
        } catch (Exception $e) {
            $this->flash->error("Este registro no se puede eliminar porque existe una integridad de datos.");

            $this->dispatcher->forward(array(
                'controller' => "actor",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("actor was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "actor",
            'action' => "index"
        ));
    }

    /**
     * select for actor
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT a.id AS actorId, a.actor_name AS actorName FROM Actor a ORDER BY a.actor_name ASC");
        $actor = null;
        foreach ($result as $row) {
            $actor[$row->actorId] = $row->actorName;
        }
        $content = json_encode($actor);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }

}
