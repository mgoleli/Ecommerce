<?php 

    class Products extends Controller {
        private $productModel;
        private $categoryModel;
        private $manufactureModel;
        public function __construct(){
            new Session;
            $this->productModel = $this->model('Product');
            $this->categoryModel = $this->model('Category');
            $this->manufactureModel = $this->model('Manufacture');
        }

  
        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'Tüm ürünler';
            $data['products'] = $this->productModel->getAllPro();
            $this->view('products.all', $data);
        }


        public function show($id){
            Auth::adminAuth();
            $data['product'] = $this->productModel->show($id);
            $data['title1'] = $data['product']->name;
            if($data['product'] && is_numeric($id)){
                $this->view('products.show', $data);
            }else {
                Session::set('danger', 'Bulunamadı');
                Redirect::to('products');
            }
        }


  
        public function add(){
        
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Ürün Ekle';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addProduct']){
                $name = $_POST['name'];
                $man = $_POST['man'];
                $cat = $_POST['cat'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $color = $_POST['color'];
                $size = $_POST['size'];
                $user = Session::name('admin_id');
                $description = $_POST['description'];
                $pro_img = $_FILES['image']['name'];
                $pro_tmp = $_FILES['image']['tmp_name'];
                $pro_type = $_FILES['image']['type'];
                if(!empty($pro_img)){
                    $uploaddir = dirname(ROOT).'\public\uploads\\' ;
                    $pro_img = explode('.',$pro_img);
                    $pro_img_ext = $pro_img[1];
                    $pro_img = $pro_img[0].time().'.'.$pro_img[1];

                    if($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg"
                        && $pro_img_ext != "gif" ) {
                            $data['errImg']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        }
                }else {
                    $data['errImg'] = 'Görsel Seçmelisin';
                }
                
                
                if (strlen($name) < 3) {
                    $data['errName'] = 'Ürün adı 3 karakterden az olamaz';
                }elseif($this->productModel->findProName($name) > 0) {
                    $data['errName'] = 'Ürün adı zaten mevcut';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'Ürün acıklaması 5 karakterden az olamaz';
                }
                if ($man == "Choose...") {
                    $data['errMan'] = 'Marka seçmelisin';
                }
                if ($cat== "Choose...") {
                    $data['errCat'] = 'Kategori seçmelisin';
                }
                

                if(empty($data['errCat']) && empty($data['errDes']) 
                && empty($data['errMan']) && empty($data['errPrice'])
                && empty($data['errName'])&& empty($data['errImg'])){

                    
                    move_uploaded_file($pro_tmp, $uploaddir.$pro_img);

                    $this->productModel->add($name,$description,$user,$cat,$man,$pro_img,$price,$quantity,$size,$color);
                    Session::set('success', 'Yeni ürün eklendi');
                    Redirect::to('products');
                }else {
                    $data['cat'] = $this->categoryModel->getAllCat();
                    $data['man'] = $this->manufactureModel->getAllMan();
                    $this->view('products.add', $data);
                }
             }else {
                 $data['cat'] = $this->categoryModel->getAllCat();
                 $data['man'] = $this->manufactureModel->getAllMan();
                 $this->view('products.add',$data);
            }
        }

        public function edit($id){
            Auth::adminAuth();
            $data['title1'] = 'Ürün düzenle';
            $data['product'] = $this->productModel->show($id);
            $data['man'] = $this->manufactureModel->getAllMan();
            $data['cat'] = $this->categoryModel->getAllCat();
            if($data['product'] && is_numeric($id)){
                $this->view('products.edit', $data);
            }else {
                Session::set('danger', 'Bulunamadı');
                Redirect::to('products');
            }
        }

        public function update($id){
        
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Ürün Düzenle';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editProduct']){
                $name = $_POST['name'];
                $man = $_POST['man'];
                $cat = $_POST['cat'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $color = $_POST['color'];
                $size = $_POST['size'];
                $id  = $_POST['product_id'];
                $user = Session::name('admin_id');
                $description = $_POST['description'];
                $oldImg = $_POST['oldImg'];

                $pro_img = $_FILES['image']['name'];
                $pro_tmp = $_FILES['image']['tmp_name'];
                $pro_type = $_FILES['image']['type'];
                if(!empty($pro_img)){
                    
                    $uploaddir = dirname(ROOT).'\public\uploads\\' ;
                    $pro_img = explode('.',$pro_img);
                    $pro_img_ext = $pro_img[1];
                    $pro_img = $pro_img[0].time().'.'.$pro_img[1];

                    if($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg"
                        && $pro_img_ext != "gif" ) {
                            $data['errImg']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        }
                }else {
                    $pro_img = $oldImg;
                }
                
                if (strlen($name) < 3) {
                    $data['errName'] = 'Ürün adı 3 karakterden büyük olmalı';
                }elseif($this->productModel->findProName($name,$id) > 0) {
                    $data['errName'] = 'Ürün daha önce eklenmiştir';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'Ürün açıklaması 5 karakter altında olamaz';
                }
                if ($man == "Choose...") {
                    $data['errMan'] = 'Ürün markasını seçmelisin';
                }
                if ($cat== "Choose...") {
                    $data['errCat'] = 'Ürün kategorisini seçmelisin';
                }

                if (empty($price)) {
                    $data['errPrice'] = 'Fiyat sayı olmalı';
                }

                if (empty($quantity)) {
                    $data['errQuantity'] = 'Adet girin';
                }

                

                if(empty($data['errCat']) && empty($data['errDes']) 
                && empty($data['errMan'])  && empty($data['errQuantity']) && empty($data['errPrice'])
                && empty($data['errName'])){

                    //move_uploaded_file($pro_tmp, $uploaddir.$pro_img);

                    $this->productModel->update($id,$name,$description,$user,$pro_img,$cat,$man,$price,$quantity,$size,$color);
                    Session::set('success', 'Ürün düzenleme başarılı');
                    Redirect::to('products');
                }else {
                    $data['product'] = $this->productModel->show($id);
                    $data['cat'] = $this->categoryModel->getAllCat();
                    $data['man'] = $this->manufactureModel->getAllMan();
                    $this->view('products.edit', $data);
                }
            }else {
                $data['product'] = $this->productModel->show($id);
                $data['cat'] = $this->categoryModel->getAllCat();
                $data['man'] = $this->manufactureModel->getAllMan();
                $this->view('products.edit',$data);
            }
        }


        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->productModel->activate($id);
            Session::set('success', 'Ürün aktif edildi');
            if($activate){
                Redirect::to('products');
            }
        }
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->productModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Ürün pasif hale getirildi');
                Redirect::to('products');
            }
        }
        public function delete($id){
            Auth::adminAuth();
            $data['product'] = $this->productModel->show($id);
            $ImageName = $data['product']->image;
            $image = dirname(ROOT).'/public/uploads/'.$ImageName.' ';
            if (file_exists($image)) {
                unlink($image);
            }      
            $delete =  $this->productModel->delete($id);
            if($delete){
                Session::set('success', 'Ürün silindi');
                Redirect::to('products');
            }
        }
        public function search(){
            Auth::adminAuth();
            $data['title1'] = 'Tüm Ürünler';
            $searched = $_POST['search'];
            $results = $this->productModel->search($searched);
            $data['products'] = $results;
            $this->view('products.search', $data);
            
        }
    }