<?php 

    class Pages extends Controller {
       
    
        public function index(){
            $data = [
                "title1"=>'Ana Sayfa',
            ];
            $this->view('pages.index', $data);
        }

        public function about(){
            $this->view('pages.about', ['title'=> 'Hakkımızda']);
        }

    }