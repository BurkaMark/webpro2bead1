<?php
    class Controller
    {
        /* Require the model stated in input */
        public function model($model)
        {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        }

        /* Require the view stated in input with thhe data given in input */
        public function view($view, $data = [])
        {
            if(file_exists('../app/views/' . $view . '.php'))
            {
                require_once '../app/views/' . $view . '.php';
            }
            else
            {
                die("A kért nézet nem létezik!");
            }
        }
    }
?>