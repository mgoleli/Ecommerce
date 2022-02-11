<?php 

    class Orders extends Controller {
        private $orderModel;
        public function __construct(){
            new Session;
            $this->orderModel = $this->model('order');
        }



        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'Tüm Siparişler';
            $data['orders'] = $this->orderModel->getAllOrder();
            //$data['order_status'] = $this->orderModel->getAllStatus();
            //echo "<pre>"; print_r($data['orders'] ); exit();
            $this->view('orders.all', $data);
        }



        public function show($id){
            Auth::adminAuth();
            $data['order'] = $this->orderModel->show($id);
            $data['shipping'] = $this->orderModel->showShipping($data['order']->shipping_id);
            $data['order_status'] = $this->orderModel->getAllStatus();
            $data['orderDetails'] = $this->orderModel->getAllOrderDetalails($data['order']->order_id);
            $data['title1'] = 'Order '.$data['order']->order_id;
            $id = $data['order']->order_id;
            $this->view('orders.show', $data);
        }

        public function orderStatus($id){
            Auth::adminAuth();
            $data['order_status'] = $this->orderModel->getAllStatus();
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $orderStatusID = $_POST['orderStatus'];
                //print_r($id); exit();
               $this->orderModel->statusUpdate($id, $orderStatusID);
               Session::set('success', 'Güncelleme Başarılı');
               Redirect::to('orders');
            }
        }



        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->orderModel->activate($id);
            Session::set('success', 'Aktif edildi');
            if($activate){
                Redirect::to('orders');
            }
        }
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->orderModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Pasif duruma getirildi');
                Redirect::to('orders');
            }
        }


        public function delete($id){
            Auth::adminAuth();
            $delete =  $this->orderModel->delete($id);
            Session::set('success', 'Silme Başarılı');
            Redirect::to('orders');
            
        }

    }