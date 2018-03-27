<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class BranchofficeController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for branchoffice
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Branchoffice', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $branchoffice = Branchoffice::find($parameters);
        if (count($branchoffice) == 0) {
            $this->flash->notice("The search did not find any branchoffice");

            $this->dispatcher->forward(array(
                "controller" => "branchoffice",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $branchoffice,
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
     * Edits a branchoffice
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $branchoffice = Branchoffice::findFirstByid($id);
            if (!$branchoffice) {
                $this->flash->error("branchoffice was not found");

                $this->dispatcher->forward(array(
                    'controller' => "branchoffice",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $branchoffice->id;

            $this->tag->setDefault("id", $branchoffice->getId());
            $this->tag->setDefault("branchoffice_name", $branchoffice->getBranchofficeName());
            $this->tag->setDefault("branchoffice_phone", $branchoffice->getBranchofficePhone());
            $this->tag->setDefault("branchoffice_address", $branchoffice->getBranchofficeAddress());
            
        }
    }

    /**
     * Creates a new branchoffice
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "branchoffice",
                'action' => 'index'
            ));

            return;
        }

        $branchoffice = new Branchoffice();
        $branchoffice->setBranchofficeName($this->request->getPost("branchoffice_name"));
        $branchoffice->setBranchofficePhone($this->request->getPost("branchoffice_phone"));
        $branchoffice->setBranchofficeAddress($this->request->getPost("branchoffice_address"));
        

        if (!$branchoffice->save()) {
            foreach ($branchoffice->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "branchoffice",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("branchoffice was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "branchoffice",
            'action' => 'index'
        ));
    }

    /**
     * Saves a branchoffice edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "branchoffice",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $branchoffice = Branchoffice::findFirstByid($id);

        if (!$branchoffice) {
            $this->flash->error("branchoffice does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "branchoffice",
                'action' => 'index'
            ));

            return;
        }

        $branchoffice->setBranchofficeName($this->request->getPost("branchoffice_name"));
        $branchoffice->setBranchofficePhone($this->request->getPost("branchoffice_phone"));
        $branchoffice->setBranchofficeAddress($this->request->getPost("branchoffice_address"));
        

        if (!$branchoffice->save()) {

            foreach ($branchoffice->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "branchoffice",
                'action' => 'edit',
                'params' => array($branchoffice->id)
            ));

            return;
        }

        $this->flash->success("branchoffice was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "branchoffice",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a branchoffice
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $branchoffice = Branchoffice::findFirstByid($id);
        if (!$branchoffice) {
            $this->flash->error("branchoffice was not found");

            $this->dispatcher->forward(array(
                'controller' => "branchoffice",
                'action' => 'index'
            ));

            return;
        }

        try {
            $branchoffice->delete();
        } catch (Exception $e) {
            $this->flash->error("Este registro no se puede eliminar porque existe una integridad de datos.");

            $this->dispatcher->forward(array(
                'controller' => "branchoffice",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("branchoffice was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "branchoffice",
            'action' => "index"
        ));
    }

    /**
     * select for branchoffice
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT b.id AS branchofficeId, b.branchoffice_name AS branchofficeName FROM Branchoffice b ORDER BY b.branchoffice_name ASC");
        $branchoffice = null;
        foreach ($result as $row) {
            $branchoffice[$row->branchofficeId] = $row->branchofficeName;
        }
        $content = json_encode($branchoffice);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }

}
