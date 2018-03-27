<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class FormatController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for format
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Format', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $format = Format::find($parameters);
        if (count($format) == 0) {
            $this->flash->notice("The search did not find any format");

            $this->dispatcher->forward(array(
                "controller" => "format",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $format,
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
     * Edits a format
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $format = Format::findFirstByid($id);
            if (!$format) {
                $this->flash->error("format was not found");

                $this->dispatcher->forward(array(
                    'controller' => "format",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $format->id;

            $this->tag->setDefault("id", $format->getId());
            $this->tag->setDefault("format_name", $format->getFormatName());
            
        }
    }

    /**
     * Creates a new format
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "format",
                'action' => 'index'
            ));

            return;
        }

        $format = new Format();
        $format->setFormatName($this->request->getPost("format_name"));
        

        if (!$format->save()) {
            foreach ($format->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "format",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("format was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "format",
            'action' => 'index'
        ));
    }

    /**
     * Saves a format edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "format",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $format = Format::findFirstByid($id);

        if (!$format) {
            $this->flash->error("format does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "format",
                'action' => 'index'
            ));

            return;
        }

        $format->setFormatName($this->request->getPost("format_name"));
        

        if (!$format->save()) {

            foreach ($format->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "format",
                'action' => 'edit',
                'params' => array($format->id)
            ));

            return;
        }

        $this->flash->success("format was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "format",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a format
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $format = Format::findFirstByid($id);
        if (!$format) {
            $this->flash->error("format was not found");

            $this->dispatcher->forward(array(
                'controller' => "format",
                'action' => 'index'
            ));

            return;
        }

        try {
            $format->delete();
        } catch (Exception $e) {
            $this->flash->error("Este registro no se puede eliminar porque existe una integridad de datos.");

            $this->dispatcher->forward(array(
                'controller' => "format",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("format was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "format",
            'action' => "index"
        ));
    }

    /**
     * select for format
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT f.id AS formatId, f.format_name AS formatName FROM Format f ORDER BY f.format_name ASC");
        $format = null;
        foreach ($result as $row) {
            $format[$row->formatId] = $row->formatName;
        }
        $content = json_encode($format);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }

}
