<?php 

    class Users extends Controller {


        private $userModel;
        private $cartModel;

        private $vkey ;
        public function __construct(){
            new Session();
            $this->userModel = $this->model('User');
            $this->cartModel = $this->model('Cart');
        }


  
        public function register(){
            Auth::userGuest();
            $data['title1'] = 'Kayıt';
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($_POST['register']){
                   $fullname = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
                   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                   $password = $_POST['password'];
                   $hashedPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);
                   $password2 = $_POST['password2'];

                   $vkey = time();
                   $vkey = md5($vkey);
                   $vkey = str_shuffle($vkey);

                   if (empty($fullname)) {
                       $data['errName'] = 'Ad girmelisiniz.';
                   }

                   if (empty($email)) {
                        $data['errEmail'] = 'Email boş bırakılamaz.';
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Email adresi giriniz';
                    }
                    elseif($this->userModel->findUserByEmail($email)){
                        $data['errEmail'] = 'Email mevcut';
                    }


                    if (strlen($password) < 1) {
                        $data['errPassword'] = "Parolanız 8 karakter olmalı";
                    }


                    if ($password != $password2) {
                        $data['errPassword2'] = 'Parola uyuşmuyor';
                    }
                    if(empty($data['errEmail']) && empty($data['errName']) && empty($data['errPassword'])&& empty($data['errPassword2'])){
                        $img = 'noimage.png';
                        $this->userModel->register($fullname,$email,$img,$hashedPassword,$vkey);
                        Session::set('success','Doğrula');
                        Session::set('email',$email);
                        sendCode($vkey, $email);
                        Redirect::to('users/confirm');
                       exit();
                    }else{
                        $this->view('users.register', $data);
                    }
                }
            }else{
                
                $this->view('users.register',$data);
            }

        }



        public function update($id){
            Auth::userAuth();
            $data['title1'] = 'Profil düzenle';
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($_POST['editProfile']){
                    $fullname = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $password = $_POST['password'];
                    $oldPass = $_POST['oldPass'];
                    $hashedPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);
                  
                   if (empty($fullname)) {
                       $data['errName'] = 'Ad girmelisiniz';
                   }

                if(empty($password)){
                    $hashedPassword = $oldPass;
                }

                   if (empty($email)) {
                        $data['errEmail'] = 'Email girmelisiniz';
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Email giriniz';
                    }
                    elseif($this->userModel->findUserByEmail($email,$id)){
                        $data['errEmail'] = 'Email mevcut';
                    }


                    if(empty($data['errEmail']) && empty($data['errName']) && empty($data['errPassword'])){
                        $this->userModel->update($id,$fullname,$email,$hashedPassword);
                        Session::set('user_name',$fullname);
                        Session::set('success','Profiliniz güncellendi');
                        Redirect::to('users/profile');
                       
                    }else{
                        $data['user'] = $this->userModel->show($id);
                        $this->view('users.edit', $data);
                    }
                }
            }else{
                $data['user'] = $this->userModel->show($id);
                $this->view('users.edit', $data);
            }

        }



        public function login(){
            Auth::userGuest();
            $data['title1'] = 'Giriş';
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($_POST['login']){
                   $email = $_POST['email'];
                   $password = $_POST['password'];
                  
                   if (empty($email)) {
                        $data['errEmail'] = 'mail girmelisiniz';
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Email giriniz';
                    }elseif($this->userModel->findUserByEmail($email) == false){
                        $data['errEmail'] = 'E-mail bulunamadı';
                    }

                    if (empty($password)) {
                        $data['errPassword'] = "Parola giriniz.";
                    }

                    if(empty($data['errEmail']) && empty($data['errPassword'])){
                        $user = $this->userModel->login($email,$password);
                        if($user){
                           if($this->userModel->notVerified($email)){
                               Session::set('email', $email);
                               Session::set('danger', "Hesabı doğrula <a href='".URL."/users/confirm'>Hesabı doğrula</a>");
                                $this->view('users.login', $data);
                           }else {
                               Session::set('user_id',$user->user_id);
                                $cartItems = 0;
                                $carts = $this->cartModel->getAllCart();
                                if($carts){
                                    foreach ($carts as $cart) {
                                       $cartItems = $cartItems +  $cart->qty;
                                    }
                                }else {
                                    $cartItems = 0;
                                }
                                Session::set('user_img',$user->image);
                                Session::set('user_cart', $cartItems );                               
                                Session::set('user_name',$user->full_name);
                                Redirect::to('users/profile');
                           };
                        }else {
                            $data['errPassword'] = "Parola uyuşmuyor";
                            $this->view('users.login', $data);
                        }
                    }else{
                        
                        $this->view('users.login', $data);
                    }
                }
            }else {
                $this->view('users.login',$data);
            }
        }


        public function logout(){
            Auth::userAuth();
            Session::clear('user_name');
            Session::clear('user_id');
            Session::destroy();
            Redirect::to('users/login');
        }




        public function avatar($id){
        
            Auth::userAuth();
            $data['title1'] = 'Avatar Düzenle';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addAvatar']){

                echo $pro_img = $_FILES['image']['name'];
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
                    $data['errImg'] = 'Görsel seçmelisiniz.';
                }
                

                if(empty($data['errImg'])){
                    move_uploaded_file($pro_tmp, $uploaddir.$pro_img);
                    unlink($uploaddir.Session::name('user_img'));
                    $this->userModel->avatar($id,$pro_img);
                    Session::set('user_img',$pro_img );
                    Session::set('success', 'Avatar güncellendi');
                    Redirect::to('users/profile');
                }else {
                    $this->view('users.avatar', $data);
                }
             }else {
                 $this->view('users.avatar',$data);
            }
        }



    
  

        public function profile(){
            Auth::userAuth();
            $data['title1'] = 'Profil';
            $name = Session::name('user_name');
            $user_id = Session::name('user_id');
            $user = $this->userModel->userData($name,$user_id);
            
            $data['user'] = $user;
            if(Session::existed('email')){
                Session::clear('email');
            }
            $this->view('users.profile', $data);
            
        }


        public function edit($id){
            Auth::userAuth();
            $data['title1'] = 'Profil Düzenle';
            $data['user'] = $this->userModel->show($id);
            if($data['user'] && is_numeric($id)){
                $this->view('users.edit', $data);
            }else {
                Session::set('danger', 'Bulunamadı');
                Redirect::to('users');
            }
        }

    }