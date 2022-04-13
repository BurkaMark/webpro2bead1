<?php
    class Pages extends Controller
    {
        public function __construct()
        {

        }

        public function index()
        {
            $data = ['title' => 'Fő oldal'];
            $this->view('index', $data);
        }
    }
?>