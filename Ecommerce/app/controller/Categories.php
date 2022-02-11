<?php 

    class Categories extends Controller {
        private $categoryModel;
        public function __construct(){
            new Session;
            $this->categoryModel = $this->model('Category');
        }


        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'Tüm kategoriler';
            $data['categories'] = $this->categoryModel->getAllCat();
            $this->view('categories.all', $data);
        }


        public function show($id){
            Auth::adminAuth();
            $data['category'] = $this->categoryModel->show($id);
            $data['title1'] = $data['category']->cat_name;


            if($data['category'] && is_numeric($id)){
                $this->view('categories.show', $data);
            }else {
                Session::set('danger', 'Bulunamadı');
                Redirect::to('categories');
            }
        }

        public function add(){
        
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Kategori Ekle';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addCategory']){
                $cat_name = $_POST['category'];
                $cat_user = Session::name('admin_id');
                $description = $_POST['description'];

                if (strlen($cat_name) < 3) {
                    $data['errCat'] = 'Kategori adı 3 karakterden az olamaz';
                }elseif($this->categoryModel->findCatName($cat_name) > 0) {
                    $data['errCat'] = 'Kategori mevcut';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'Kategori açıklaması 5 karakterden az olamaz';
                }

                if(empty($data['errCat']) && empty($data['errDes'])){
                    $this->categoryModel->add($cat_name,$cat_user,$description);
                    Session::set('success', 'Kategori ekleme başarılı');
                    Redirect::to('categories');
                }else {
                    $this->view('categories.add', $data);
                }
            }else {
                $this->view('categories.add', $data);
            }
        }
        public function edit($id){
            Auth::adminAuth();
            $data['title1'] = 'Kategori Düzenle';
            $data['category'] = $this->categoryModel->show($id);
            if($data['category'] && is_numeric($id)){
                $this->view('categories.edit', $data);
            }else {
                Session::set('danger', 'Bulunamadı');
                Redirect::to('categories');
            }
        }


        public function update($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Kategori Düzenle';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editCategory']){
                $cat_name = $_POST['category'];
                $cat_id = $_POST['cat_id'];
                $description = $_POST['description'];
                $cat_user = Session::name('admin_id');

                if (strlen($cat_name) < 3) {
                    $data['errCat'] = 'Kategori adı 3 karakterden az olamaz';
                }elseif($this->categoryModel->findCatName($cat_name,$cat_id) > 0) {
                    $data['errCat'] = 'Kategori mevcut';
                }

                if (strlen($description) < 5) {
                    $data['errDes'] = 'Kategori açıklaması 5 karakterden az olama';
                }

                if(empty($data['errCat']) && empty($data['errDes'])){
                    $this->categoryModel->update($id, $cat_name,$description);
                    Session::set('success', 'Kategori güncelleme başarılı');
                    Redirect::to('categories');
                }else {
                    $data['category'] = $this->categoryModel->show($id);
                    $this->view('categories.edit', $data);
                }

            }else {
                Redirect::to('categories');
            }
        }


        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->categoryModel->activate($id);
            Session::set('success', 'Kategori aktif edildi');
            if($activate){
                Redirect::to('categories');
            }
        }


        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->categoryModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Kategori pasif hale getirildi');
                Redirect::to('categories');
            }
        }


        public function search(){
            Auth::adminAuth();
            $data['title1'] = 'Tüm Kategoriler';
            $searched = $_POST['search'];
            $results = $this->categoryModel->search($searched);
            $data['categories'] = $results;
            $this->view('categories.search', $data);
            
        }

        public function delete($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Kategori silindi');
            $delete =  $this->categoryModel->delete($id);
            if($delete){
                Redirect::to('categories');
            }
        }

    }