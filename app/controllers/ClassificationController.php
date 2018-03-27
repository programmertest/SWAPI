<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ClassificationController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for classification
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Classification', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $classification = Classification::find($parameters);
        if (count($classification) == 0) {
            $this->flash->notice("The search did not find any classification");

            $this->dispatcher->forward(array(
                "controller" => "classification",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $classification,
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
     * Edits a classification
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $classification = Classification::findFirstByid($id);
            if (!$classification) {
                $this->flash->error("classification was not found");

                $this->dispatcher->forward(array(
                    'controller' => "classification",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $classification->id;

            $this->tag->setDefault("id", $classification->getId());
            $this->tag->setDefault("classification_name", $classification->getClassificationName());
            
        }
    }

    /**
     * Creates a new classification
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "classification",
                'action' => 'index'
            ));

            return;
        }

        $classification = new Classification();
        $classification->setClassificationName($this->request->getPost("classification_name"));
        

        if (!$classification->save()) {
            foreach ($classification->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "classification",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("classification was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "classification",
            'action' => 'index'
        ));
    }

    /**
     * Saves a classification edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "classification",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $classification = Classification::findFirstByid($id);

        if (!$classification) {
            $this->flash->error("classification does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "classification",
                'action' => 'index'
            ));

            return;
        }

        $classification->setClassificationName($this->request->getPost("classification_name"));
        

        if (!$classification->save()) {

            foreach ($classification->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "classification",
                'action' => 'edit',
                'params' => array($classification->id)
            ));

            return;
        }

        $this->flash->success("classification was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "classification",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a classification
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $classification = Classification::findFirstByid($id);
        if (!$classification) {
            $this->flash->error("classification was not found");

            $this->dispatcher->forward(array(
                'controller' => "classification",
                'action' => 'index'
            ));

            return;
        }

        try {
            $classification->delete();
            } catch (Exception $e) {
                $this->flash->error("Este registro no se puede eliminar porque existe una integridad de datos.");

                $this->dispatcher->forward(array(
                    'controller' => "classification",
                    'action' => 'search'
                ));

                return;
            }

        $this->flash->success("classification was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "classification",
            'action' => "index"
        ));
    }

    /**
     * select for classification
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT c.id AS classificationId, c.classification_name AS classificationName FROM Classification c ORDER BY c.classification_name ASC");
        $classification = null;
        foreach ($result as $row) {
            $classification[$row->classificationId] = $row->classificationName;
        }
        $content = json_encode($classification);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }

}
