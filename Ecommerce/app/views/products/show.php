
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
    <div class="   mt-4">
        <h5 class="text-center"><?php echo $data['product']->name ?></h5>
        <div class="card">
            <div class="card-header">
                <h6><?php echo $data['product']->name ?></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <img src="<?php echo URL ?>/uploads/<?php echo $data['product']->image ?>" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul class="list-unstyled">
                            <li class='my-2'>
                                <strong><i class="fa fa-product-hunt"></i> Ürün: </strong> <?php echo $data['product']->name ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-money"></i> Fiyat: </strong><span class="badge badge-info"> <?php echo $data['product']->price ?>TL</span>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-id-card"></i> ID: </strong> <?php echo $data['product']->product_id ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-heart"></i> Renk: </strong> <?php echo $data['product']->color ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-black-tie"></i> Boyut: </strong> <?php echo $data['product']->size ?>
                            </li>
                            <li class='my-2'>
                            <li class='my-2'>
                                <strong><i class="fa fa-suitcase"></i> Marka: </strong> <?php echo $data['product']->man_name?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-tag"></i> Kategori: </strong> <?php echo $data['product']->cat_name?>
                            </li>
                                <strong><i class="fa fa-list-alt"></i> Açıklama: </strong> <?php echo $data['product']->description ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-lock"></i> Durum: </strong> <?php echo $data['product']->active == 0? '<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">InActive</span>'?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-user"></i> Oluşturan: </strong> <?php echo $data['product']->creator ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-calendar"></i> Tarih: </strong> <?php echo $data['product']->created_at ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


<?php require_once ROOT ."/views/inc/adminFooter.php" ?>