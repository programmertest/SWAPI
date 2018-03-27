<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ClientController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for client
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Client', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $client = Client::find($parameters);
        if (count($client) == 0) {
            $this->flash->notice("The search did not find any client");

            $this->dispatcher->forward(array(
                "controller" => "client",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $client,
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
     * Edits a client
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $client = Client::findFirstByid($id);
            if (!$client) {
                $this->flash->error("client was not found");

                $this->dispatcher->forward(array(
                    'controller' => "client",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $client->id;

            $this->tag->setDefault("id", $client->getId());
            $this->tag->setDefault("client_name", $client->getClientName());
            $this->tag->setDefault("client_surname", $client->getClientSurname());
            $this->tag->setDefault("client_phone", $client->getClientPhone());
            $this->tag->setDefault("client_address", $client->getClientAddress());
            $this->tag->setDefault("client_mobile", $client->getClientMobile());
            $this->tag->setDefault("client_email", $client->getClientEmail());
            
        }
    }

    /**
     * Creates a new client
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "client",
                'action' => 'index'
            ));

            return;
        }

        $client = new Client();
        $client->setClientName($this->request->getPost("client_name"));
        $client->setClientSurname($this->request->getPost("client_surname"));
        $client->setClientPhone($this->request->getPost("client_phone"));
        $client->setClientAddress($this->request->getPost("client_address"));
        $client->setClientMobile($this->request->getPost("client_mobile"));
        $client->setClientEmail($this->request->getPost("client_email"));
        

        if (!$client->save()) {
            foreach ($client->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "client",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("client was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "client",
            'action' => 'index'
        ));
    }

    /**
     * Saves a client edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "client",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $client = Client::findFirstByid($id);

        if (!$client) {
            $this->flash->error("client does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "client",
                'action' => 'index'
            ));

            return;
        }

        $client->setClientName($this->request->getPost("client_name"));
        $client->setClientSurname($this->request->getPost("client_surname"));
        $client->setClientPhone($this->request->getPost("client_phone"));
        $client->setClientAddress($this->request->getPost("client_address"));
        $client->setClientMobile($this->request->getPost("client_mobile"));
        $client->setClientEmail($this->request->getPost("client_email"));
        

        if (!$client->save()) {

            foreach ($client->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "client",
                'action' => 'edit',
                'params' => array($client->id)
            ));

            return;
        }

        $this->flash->success("client was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "client",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a client
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $client = Client::findFirstByid($id);
        if (!$client) {
            $this->flash->error("client was not found");

            $this->dispatcher->forward(array(
                'controller' => "client",
                'action' => 'index'
            ));

            return;
        }

        try {
            $client->delete();
        } catch (Exception $e) {
            $this->flash->error("Este registro no se puede eliminar porque existe una integridad de datos.");

            $this->dispatcher->forward(array(
                'controller' => "client",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("client was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "client",
            'action' => "index"
        ));
    }

    /**
     * select for client
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT c.id AS clientId, c.client_name AS clientName FROM Client c ORDER BY c.client_name ASC");
        $client = null;
        foreach ($result as $row) {
            $client[$row->clientId] = $row->clientName;
        }
        $content = json_encode($client);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }
}
