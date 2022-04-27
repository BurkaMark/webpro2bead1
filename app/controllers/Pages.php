<?php
    class Pages extends Controller
    {
        /* Constructor */
        public function __construct()
        {

        }

        /* Index function */
        public function index()
        {
            $data = ['title' => 'Fő oldal'];
            $this->view('index', $data);
        }
    }
?>