
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
        <div class="">
            <div class="row">
                <div class="col-10 col-md-6  m-auto">

                <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Kategori Düzenle</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo URL?>/categories/update/<?php echo $data['category']->cat_id ?>" method="POST">
    
                                <div class="form-group">
                                    <input 
                                        value="<?php echo $data['category']->cat_name ?>"
                                        type="text" 
                                        name="category" 
                                        placeholder="Kategori Adı" 
                                        class="form-control <?php echo  isset($data['errCat']) ?  'is-invalid' : '' ?>"
                                    >
                                    <input type="hidden" name="cat_id" value="<?php echo $data['category']->cat_id ?>">
                                    <?php echo  isset($data['errCat']) ?  '<div class="invalid-feedback">'.$data['errCat'].'</div>' : '' ?>
                                </div>
                                <div class="from-group mb-2">
                                    <textarea 
                                        name="description" 
                                        class="form-control <?php echo  isset($data['errDes']) ?  'is-invalid' : '' ?>"
                                    ><?php echo $data['category']->description ?>
                                    </textarea>
                                    <?php echo  isset($data['errDes']) ?  '<div class="invalid-feedback">'.$data['errDes'].'</div>' : '' ?>
                                </div>

                                <div class="form-group">
                                <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                                <a href='<?php echo URL ?>/categories' class="btn btn-sm btn-secondary">
                                    <i class="fa fa-arrow-left"></i>
                                    Geri
                                </a>
                                    <input type="submit" name='editCategory' value='Düzenle' class="btn btn-success btn-sm">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>