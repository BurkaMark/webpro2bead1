<?php
    class Core
    {
        protected $currentController = 'Pages';
        protected $currentMethode = 'index';
        protected $params = [];

        /* Constructor */
        public function __construct()
        {
            /* Geting the url */
            $url = $this->getUrl();

            /* Checking if the url first segment is set, if yes, than set as the controller */
            if(isset($url[0]))
            {
                if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
                {
                    $this->currentController = ucwords($url[0]);
                    unset($url[0]);
                }
            }

            require_once '../app/controllers/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;

            /* Checking if the url second segment is set, if yes, than set as th methode */
            if(isset($url[1]))
            {
                if(method_exists($this->currentController, $url[1]))
                {
                    $this->currentMethode = $url[1];
                    unset($url[1]);
                }
            }

            /* If the third segment of thee url has a value, set as the parameter */
            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->currentController, $this->currentMethode], $this->params);
        }

        /* Function to get the url that the user had typed in */
        public function getUrl()
        {
            if(isset($_GET['url']))
            {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                return $url;
            }
        }
    }
?>