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

        public function about()
        {
            $this->view('about');
        }

        public function mnb()
        {
            $this->view('mnb');
        }

        public function trails()
        {
            $this->view('trails');
        }

        public function news()
        {
            $this->view('news');
        }
    }