
<?php require_once ROOT ."/views/inc/header.php" ?>


    <div class="   mt-4">
        <h5 class="text-center">Sipariş</h5>
        <div class="card my-3">
            <div class="card-header">
                <i class="fa fa-shopping-basket"></i> Sipariş Detayları
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm" >
                <?php if($data['orderDetails']){ ?>
                    <thead class='text-truncate'>
                        <th>Seri</th>
                        <th>Ürün adı</th>
                        <th>Ürün fiyat</th>
                        <th>Sipariş Durumu</th>
                        <th>Adet</th>
                        <th>Ara toplam</th>
                    </thead>
                    <?php 
                
                        $i = 0;
                        foreach ($data['orderDetails'] as $order) { $i++?>
                            <tbody>
                                <td><?php echo $i ?></td>
                                <td><?php echo $order->product_name ?></td>
                                <td><?php echo number_format($order->product_price,2) ?>TL</td>
                                <td><?php echo $order->name; ?></td>
                                <td><?php echo $order->product_qty ?></td>
                                <td><?php echo number_format($order->product_price * $order->product_qty,2) ?>TL</td>
                            </tbody>
                            <?php } 
                        }else{?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> Sipariş yok</p>
                    <?php  }
                ?>
                    
                </table>
            </div>
        </div>
    </div>
<?php require_once ROOT ."/views/inc/footer.php" ?>