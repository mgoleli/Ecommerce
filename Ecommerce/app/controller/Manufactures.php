<?php 

    class Manufactures extends Controller {
        private $manufactureModel;
        public function __construct(){
            new Session;
            $this->manufactureModel = $this->model('Manufacture');
        }


    
        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'Tüm Markalar';
            $data['manufactures'] = $this->manufactureModel->getAllMan();
            $this->view('manufactures.all', $data);
        }


        public function search(){
            Auth::adminAuth();
            $data['title1'] = 'Tüm Markalar';
            $searched = $_POST['search'];
            $results = $this->manufactureModel->search($searched);
            $data['manufactures'] = $results;
            $this->view('manufactures.search', $data);
            
        }


        public function show($id){
            Auth::adminAuth();
            $data['manufacture'] = $this->manufactureModel->show($id);
            $data['title1'] = $data['manufacture']->man_name;
            if($data['manufacture'] && is_numeric($id)){
                $this->view('manufactures.show', $data);
            }else {
                Session::set('danger', 'Bulunamadı');
                Redirect::to('manufactures');
            }
        }



        public function add(){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Marka ekle';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addManufacture']){
                $man_name = $_POST['manufacture'];
                $man_user = Session::name('admin_id');
                $description = $_POST['description'];

                if (strlen($man_name) < 3) {
                    $data['errMan'] = 'Marka 3 karakterden küçük olamaz';
                }elseif($this->manufactureModel->findManName($man_name) > 0) {
                    $data['errMan'] = 'Marka mevcut';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'Marka acıklaması 5 karakterden küçük olamaz';
                }

                if(empty($data['errMan']) && empty($data['errDes'])){
                    $this->manufactureModel->add($man_name,$man_user,$description);
                    Session::set('success', 'Marka eklemesi başarılı');
                    Redirect::to('manufactures');
                }else {
                    $this->view('manufactures.add', $data);
                }
            }else {
                $this->view('manufactures.add',$data);
            }
        }


        public function edit($id){
            Auth::adminAuth();
            $data['title1'] = 'Marka Düzenle';
            $data['manufacture'] = $this->manufactureModel->show($id);
            if($data['manufacture'] && is_numeric($id)){
                $this->view('manufactures.edit', $data);
            }else {
                Session::set('danger', 'Bulunamadı');
                Redirect::to('manufactures');
            }
        }


        public function update($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Marka BrDüzenleand';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editManufacture']){
                $man_name = $_POST['manufacture'];
                $man_id = $_POST['man_id'];
                $description = $_POST['description'];
                $man_user = Session::name('admin_id');

                if (strlen($man_name) < 3) {
                    $data['errMan'] = 'Marka adı 3  karakterden küçük olamaz';
                }elseif($this->manufactureModel->findManName($man_name,$man_id) > 0) {
                    $data['errMan'] = 'Marka adı mevcut';
                }

                if (strlen($description) < 5) {
                    $data['errDes'] = 'Marka acıklaması 5 karakterden küçük olamaz';
                }

                if(empty($data['errMan']) && empty($data['errDes'])){
                    $this->manufactureModel->update($id, $man_name,$description);
                    Session::set('success', 'Güncelleme başarılı');
                    Redirect::to('manufactures');
                }else {
                    $data['manufacture'] = $this->manufactureModel->show($id);
                    $this->view('manufactures.edit', $data);
                }

            }else {
                Redirect::to('manufactures');
            }
        }



        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->manufactureModel->activate($id);
            Session::set('success', 'Marka aktif edildi');
            if($activate){
                Redirect::to('manufactures');
            }
        }



        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->manufactureModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Marka pasif duruma getirildi');
                Redirect::to('manufactures');
            }
        }


        public function delete($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Silme başarılı');
            $delete =  $this->manufactureModel->delete($id);
            if($delete){
                Redirect::to('manufactures');
            }
        }

    }