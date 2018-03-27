<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class RentController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for rent
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Rent', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }

        // QueryBuilder
        $rent = $this->modelsManager->createBuilder();
        $rent->columns([
            'r.id AS rentId',
            'b.branchoffice_name AS branchofficeName',
            'CONCAT(c.client_name, " ", c.client_surname) AS clientName',
            'm.movie_name AS movieName',
            'r.rent_stardate AS starDate',
            'r.rent_returndate AS returnDate',
            'r.rent_value AS value',
            'r.rent_amount AS amount'
        ]);
        $rent->from(['r' => 'Rent']);
        $rent->innerJoin('Branchoffice', 'b.id = r.branchoffice_id', 'b');
        $rent->innerJoin('Client', 'c.id = r.client_id', 'c');
        $rent->innerJoin('Movie', 'm.id = r.movie_id', 'm');

        // Order
        $rent->orderBy('r.id ASC');

        if (count($rent) == 0) {
            $this->flash->notice("The search did not find any rent");

            $this->dispatcher->forward(array(
                "controller" => "rent",
                "action" => "index"
            ));

            return;
        }

        $paginator = new \Phalcon\Paginator\Adapter\QueryBuilder(array(
            'builder' => $rent,
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
     * Edits a rent
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $rent = Rent::findFirstByid($id);
            if (!$rent) {
                $this->flash->error("rent was not found");

                $this->dispatcher->forward(array(
                    'controller' => "rent",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $rent->id;

            $this->tag->setDefault("id", $rent->getId());
            $this->tag->setDefault("branchoffice_id", $rent->getBranchofficeId());
            $this->tag->setDefault("client_id", $rent->getClientId());
            $this->tag->setDefault("movie_id", $rent->getMovieId());
            $this->tag->setDefault("rent_stardate", $rent->getRentStardate());
            $this->tag->setDefault("rent_returndate", $rent->getRentReturndate());
            $this->tag->setDefault("rent_value", $rent->getRentValue());
            $this->tag->setDefault("rent_amount", $rent->getRentAmount());
            
        }
    }

    /**
     * Creates a new rent
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "rent",
                'action' => 'index'
            ));

            return;
        }

        $rent = new Rent();
        $rent->setBranchofficeId($this->request->getPost("branchoffice_id"));
        $rent->setClientId($this->request->getPost("client_id"));
        $rent->setMovieId($this->request->getPost("movie_id"));
        $rent->setRentStardate($this->request->getPost("rent_stardate"));
        $rent->setRentReturndate($this->request->getPost("rent_returndate"));
        $rent->setRentValue($this->request->getPost("rent_value"));
        $rent->setRentAmount($this->request->getPost("rent_amount"));
        

        if (!$rent->save()) {
            foreach ($rent->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "rent",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("rent was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "rent",
            'action' => 'index'
        ));
    }

    /**
     * Saves a rent edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "rent",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $rent = Rent::findFirstByid($id);

        if (!$rent) {
            $this->flash->error("rent does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "rent",
                'action' => 'index'
            ));

            return;
        }

        $rent->setBranchofficeId($this->request->getPost("branchoffice_id"));
        $rent->setClientId($this->request->getPost("client_id"));
        $rent->setMovieId($this->request->getPost("movie_id"));
        $rent->setRentStardate($this->request->getPost("rent_stardate"));
        $rent->setRentReturndate($this->request->getPost("rent_returndate"));
        $rent->setRentValue($this->request->getPost("rent_value"));
        $rent->setRentAmount($this->request->getPost("rent_amount"));
        

        if (!$rent->save()) {

            foreach ($rent->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "rent",
                'action' => 'edit',
                'params' => array($rent->id)
            ));

            return;
        }

        $this->flash->success("rent was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "rent",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a rent
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $rent = Rent::findFirstByid($id);
        if (!$rent) {
            $this->flash->error("rent was not found");

            $this->dispatcher->forward(array(
                'controller' => "rent",
                'action' => 'index'
            ));

            return;
        }

        if (!$rent->delete()) {

            foreach ($rent->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "rent",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("rent was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "rent",
            'action' => "index"
        ));
    }

}
