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

        public function mnb()
        {
            $this->view('mnb');
        }

        public function trail()
        {
            $this->view('trail');
        }

        public function newsandblog()
        {
            $this->view('newsandblogs');
        }
    }
?>