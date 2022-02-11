<?php 

    class Carts extends Controller {
        private $cartModel;
        private $orderModel;
        public function __construct(){
            new Session;
            $this->cartModel = $this->model('Cart');
            $this->orderModel = $this->model('Order');
        }


        public function index(){
            Auth::userAuth();
            $data['title1'] = 'Sepet';
            $cartItems = 0;
            $data['cart'] = $this->cartModel->getAllCart();
            if($data['cart']){
                foreach ($data['cart'] as $cart) {
                    $cartItems = $cartItems +  $cart->qty;
                }
            }else {
                $cartItems = 0;
            }
            Session::set('user_cart', $cartItems );
            $this->view('front.cart',$data);
        }


        public function thank(){
            Auth::userAuth();
            $data['title1'] = 'Teşekkürler';
            $data['title2'] = 'ödeme tamamlandı';
            $this->view('front.thank',$data);
        }



        public function orders(){
            Auth::userAuth();
            $data['title1'] = 'Orders';
            $data['orderDetails'] = $this->orderModel->getUserOrderDetalails(Session::name('user_id'));
            $this->view('front.orders',$data);
        }

        public function add($pro_id,$price){
            Auth::userAuth();
            $user_id = Session::name('user_id');
            if($this->cartModel->findCartPro($pro_id,$user_id) > 0){
                $this->cartModel->addOne($pro_id,$user_id);
                Redirect::to('carts');
            }else{
                $this->cartModel->addnew($pro_id,$user_id,$price);
                Redirect::to('carts');
            }
        }

        public function updateQty($id){
            Auth::userAuth();
            Csrf::CsrfToken();
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['upQty']){
                $qty = $_POST['qty'];

                if ($qty < 1 && empty($qty)) {
                    Redirect::to('carts');
                    Session::set('error', 'Ürün istenilen miktarda stokta bulunmamaktadır');
                }else {
                    $this->cartModel->updateQty($id,$qty);
                    Session::set('success', 'Miktar güncellendi');
                    Redirect::to('carts');
                }
            }
        }

        public function delete($id){
            Auth::userAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Silme başarılı');
            $delete =  $this->cartModel->delete($id);
            if($delete){
                Redirect::to('carts');
            }
        }

        public function clear(){
            Auth::userAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Temizle başarılı');
            $delete =  $this->cartModel->clear();
            if($delete){
                Redirect::to('carts');
            }
        }




        public function checkout(){
            Auth::userAuth();
            Csrf::CsrfToken();
            if($_SERVER['REQUEST_METHOD']=='POST'){
                
                $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
                $name = $_POST['name'];
                $email = $_POST['email'];
                $mobile = $_POST['mobile'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $total = $_POST['total'];
                $qty = $_POST['qty'];

                
                if(empty($_POST['payment_method'])){
                    $data['errMethod'] = 'Ödeme metodu seçmelisiniz.';
                }
                if (strlen($name) < 2) {
                $data['errName'] = 'Ad 2 karakterden kısa isim olamaz';
                }
                if (empty($email)) {
                    $data['errEmail'] = 'E-mail adresi giriniz.';
                }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    $data['errEmail'] = 'E-mail adresi giriniz';
                }

                if (strlen($mobile) < 11) {
                    $data['errMobile'] = 'Telefon numarası 11 haneden küçük olamaz';
                }

                if (empty($address)) {
                    $data['errAddress'] = 'Adres zorunludur';
                }
                if (empty($city)) {
                    $data['errCity'] = 'Şehir zorunludur.';
                }

                if(empty($data['errName']) && empty($data['errEmail'])
                    && empty($data['errMobile']) && empty($data['errAddress']) 
                    && empty($data['errCity']) && empty($data['errMethod'])){


                    $shipping_id= $this->orderModel->addToShipping($name,$email,$mobile,$address,$city);
                    Session::set('shipping_id', $shipping_id);
                    
                    //complete order
                    $payment_id= $this->orderModel->addToPayment($_POST['payment_method'],$shipping_id);
                    
                    $order_id = $this->orderModel->addToOrder(
                        Session::name('user_id'),$shipping_id,$payment_id
                        ,$total
                    );

                    $data['cart'] = $this->cartModel->getAllCart();
                    foreach ($data['cart'] as $cart) {
                        $this->orderModel->addToOrderDetails(
                            $order_id,$cart->product,$cart->pro_name,
                            $cart->price ,$cart->qty,Session::name('user_id')
                        );
                    }

                    $this->cartModel->clear();
                    Session::set('user_cart', '0');
                    Redirect::to("carts/thank");
                
                }else {
                    $data['cart'] = $this->cartModel->getAllCart();
                    $this->view('front.cart', $data);
                }
            }else {
                Redirect::to('carts');
            }
        }
    }