<?php require_once ROOT ."/views/inc/header.php" ?>

    <div class=" text-center mt-4">
        <h3 ><?php echo $data['title2'] ?></h3>
        <h5 class="text-muted my-3"> 
            Siparişiniz Alınmıştır.
        </h5>
        <a href="<?php echo URL ?>/carts/orders/" class='d-block mb-3'>Siparişe git</a>
        <a href="<?php echo URL ?>/home" class="btn btn-secondary btn-sm" style="font-size:13px"><i class="fa fa-arrow-left"></i> Geri</a>
    </div>