
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>

    <div class="  text-center mt-4">

        <h5>Sipariş Yönetimi</h5>
        <?php if($data['orders']){?> 
        <table class="table table-dark table-responsive-md">
            <thead class='text-truncate'>
                <tr>
                    <th>#ID</th>
                    <th>Müşteri Adı</th>
                    <th>Sipariş </th>
                    <th>Ödeme Metodu</th>
                    <th>Durumlar</th>
                    <th>Aksiyonlar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                

                
                    foreach ( $data['orders'] as $order) {?>                        
                    <tr>
                        <td><?php echo $order->order_id ?></td>
                        <td><?php echo $order->creator ?></td>
                        <td><?php echo $order->order_total ?>TL</td>
                        <td><?php echo $order->method ?></td>
                            <td>
                                <a href="<?php echo URL ?>/orders/<?php echo $order->order_status == 0 ? 'activate':'inActivate'?>/<?php echo $order->order_id ?>">
                                    <?php echo $order->order_status == 0 ? '<i class="fa fa-thumbs-down text-secondary"></i>':'<i class="fa fa-thumbs-up  text-success"></i>' ?>
                                </a>
                            </td>
                        <td>
                            <a href="<?php echo URL ?>/orders/delete/<?php echo $order->shipping_id?>" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
                            <a href="<?php echo URL ?>/orders/show/<?php echo $order->order_id?>" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                        </td>
                    </tr>
                <?php } 
                
                ?>
            </tbody>
        </table>
        <?php }else{?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span>Sipariş Yok</p>
                    <?php  }?> 
    </div>


<?php require_once ROOT ."/views/inc/adminFooter.php" ?>