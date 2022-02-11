
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>

    <div class="   mt-4">
        <h4 class="text-center">Sipariş Detayları</h4>
        <div class="row">
        
            <div class="col-md-5">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-list"></i> Müşteri Detayları
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" >
                            <thead class='text-truncate'>
                                <th><i class="fa fa-user"></i> Müşteri Adı</th>
                                <th><i class="fa fa-mobile"></i> Telefon</th>
                            </thead>
                            <tbody>
                                <td> <?php Session::get('user_name') ?></td>
                                <td><?php echo $data['shipping']->mobile ?></td>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-list"></i>Sipariş Detayları
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive" >
                            <thead class='text-truncate'>
                                <th><i class="fa fa-user"></i>Kullanıcı Adı</th>
                                <th><i class="fa fa-user"></i>Adres</th>
                                <th><i class="fa fa-mobile"></i>Telefon</th>
                                <th><i class="fa fa-envelope"></i>E-Mail</th>
                            </thead>
                            <tbody>
                                <td><?php echo $data['shipping']->full_name ?></td>
                                <td>
                                <?php echo $data['shipping']->address ?>, 
                                    <?php echo $data['shipping']->city ?>
                                </td>
                                <td><?php echo $data['shipping']->mobile ?></td>
                                <td><?php echo $data['shipping']->email ?></td>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-shopping-basket"></i> Sipariş Detayları
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-sm" >
                            <thead class='text-truncate'>
                                <th>ID</th>
                                <th>Ürün Adı</th>
                                <th>Ürün Fiyat</th>
                                <th>Sipariş Durumu</th>
                                <th>Miktar</th>
                                <th>Ara Toplam</th>
                            </thead>
                            <?php 
                                $i = 0;
                                foreach ($data['orderDetails'] as $order) { $i++?>
                                    <tbody>
                                        <td><?php echo $order->product_id ?></td>
                                        <td><?php echo $order->product_name ?></td>
                                        <td><?php echo number_format($order->product_price,2) ?>TL</td>
                                        <td><?php echo $order->name; ?></td>
                                        <td><?php echo $order->product_qty ?></td>
                                        <td><?php echo number_format($order->product_price * $order->product_qty,2) ?>TL</td>
                                    </tbody>
                                <?php }
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
            <form action="<?php echo URL?>/orders/orderStatus/<?php echo "order_id=".$data['order']->order_id. "" ?>" method="POST">
                <label>Sipariş Statü</label>
               
                <select name="orderStatus">
                <?php foreach ($data['order_status'] as $statu) { $i++ ?> 
                    <option value="<?php echo $statu->order_status_id?>"><?php echo $statu->name ;?></option>
                    <?php } ?>
                </select>
             
                <button type="submit" class="btn btn-secondary m-3 statuUpdate">Güncelle</button>
                </form>
            </div>
        </div>
    
        <a href='<?php echo URL ?>/orders' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Geri
        </a>
    </div>


<?php require_once ROOT ."/views/inc/adminFooter.php" ?>