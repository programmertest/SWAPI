<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class CountryController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for country
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Country', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "country_code";

        $country = Country::find($parameters);
        if (count($country) == 0) {
            $this->flash->notice("The search did not find any country");

            $this->dispatcher->forward(array(
                "controller" => "country",
                "action" => "index"
            ));

            return;
        }

        $paginator = new Paginator(array(
            'data' => $country,
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
     * Edits a country
     *
     * @param string $country_code
     */
    public function editAction($country_code)
    {
        if (!$this->request->isPost()) {

            $country = Country::findFirstBycountry_code($country_code);
            if (!$country) {
                $this->flash->error("country was not found");

                $this->dispatcher->forward(array(
                    'controller' => "country",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->country_code = $country->country_code;

            $this->tag->setDefault("country_code", $country->getCountryCode());
            $this->tag->setDefault("country_name", $country->getCountryName());
            
        }
    }

    /**
     * Creates a new country
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "country",
                'action' => 'index'
            ));

            return;
        }

        $country = new Country();
        $country->setCountryCode($this->request->getPost("country_code"));
        $country->setCountryName($this->request->getPost("country_name"));
        

        if (!$country->save()) {
            foreach ($country->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "country",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("country was created successfully");

        $this->dispatcher->forward(array(
            'controller' => "country",
            'action' => 'index'
        ));
    }

    /**
     * Saves a country edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "country",
                'action' => 'index'
            ));

            return;
        }

        $country_code = $this->request->getPost("country_code");
        $country = Country::findFirstBycountry_code($country_code);

        if (!$country) {
            $this->flash->error("country does not exist " . $country_code);

            $this->dispatcher->forward(array(
                'controller' => "country",
                'action' => 'index'
            ));

            return;
        }

        $country->setCountryCode($this->request->getPost("country_code"));
        $country->setCountryName($this->request->getPost("country_name"));
        

        if (!$country->save()) {

            foreach ($country->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "country",
                'action' => 'edit',
                'params' => array($country->country_code)
            ));

            return;
        }

        $this->flash->success("country was updated successfully");

        $this->dispatcher->forward(array(
            'controller' => "country",
            'action' => 'index'
        ));
    }

    /**
     * Deletes a country
     *
     * @param string $country_code
     */
    public function deleteAction($country_code)
    {
        $country = Country::findFirstBycountry_code($country_code);
        if (!$country) {
            $this->flash->error("country was not found");

            $this->dispatcher->forward(array(
                'controller' => "country",
                'action' => 'index'
            ));

            return;
        }

        if (!$country->delete()) {

            foreach ($country->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "country",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("country was deleted successfully");

        $this->dispatcher->forward(array(
            'controller' => "country",
            'action' => "index"
        ));
    }

    /**
     * select for country
     */
    public function selectAction()
    {
        $result = $this->modelsManager->executeQuery("SELECT c.country_code AS countryCode, c.country_name AS countryName FROM Country c ORDER BY c.country_name ASC");
        $country = null;
        foreach ($result as $row) {
            $country[$row->countryCode] = $row->countryName;
        }
        $content = json_encode($country);

        $response = new \Phalcon\Http\Response();
        $response->setContent($content);
        return $response;
    }

}
