
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
        <div class=" ">
            <div class="row">
                <div class="col-10 col-md-6  m-auto">
                
                <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Ürün Düzenle</h5>
                        </div>
                        <div class="card-body">
                            <form enctype='multipart/form-data' action="<?php echo URL?>/products/update/<?php echo $data['product']->product_id ?>" method="POST">


                                <input type="hidden" name="oldImg" value='<?php echo $data['product']->image?>'>
                                <div class="form-group">
                                    <input value='<?php echo $data['product']->name?>' type="text" name="name" placeholder="Ürün Adı" class="form-control <?php echo  isset($data['errName']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errName']) ?  '<div class="invalid-feedback">'.$data['errName'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input value='<?php echo $data['product']->color?>' type="text" name="color" placeholder="Renk" class="form-control <?php echo  isset($data['errColor']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errColor']) ?  '<div class="invalid-feedback">'.$data['errColor'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input value='<?php echo $data['product']->size?>' type="text" name="size" placeholder="Size" class="form-control <?php echo  isset($data['errSize']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errSize']) ?  '<div class="invalid-feedback">'.$data['errSize'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input value='<?php echo $data['product']->price?>' type="text" name="price" placeholder="Fiyat" class="form-control <?php echo  isset($data['errPrice']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errPrice']) ?  '<div class="invalid-feedback">'.$data['errPrice'].'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="quantity" placeholder="Miktar " class="form-control <?php echo  isset($data['errQuantity']) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($data['errQuantity']) ?  '<div class="invalid-feedback">'.$data['errQuantity'].'</div>' : '' ?>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input name='image' type="file" class="custom-file-input <?php echo  isset($data['errImg']) ?  'is-invalid' : '' ?>" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Görsel Ekle</label>
                                    </div>
                                </div>
                                <small><?php echo  isset($data['errImg']) ?  '<div class="text-danger">'.$data['errImg'].'</div>' : '' ?></small>
                                <div class="input-group mb-3">
                                    
                                    <select class="custom-select <?php echo  isset($data['errCat']) ?  'is-invalid' : '' ?>" id="inputGroupSelect01" name='cat'>
                                        <option value ='Choose...'>Choose...</option>
                                    <?php 
                                            foreach ($data['cat'] as $cat) { ?>
                                               <option  value="<?php echo $cat->cat_id?>"
                                               <?php echo $cat->cat_id==$data['product']->cat ? 'selected':''?>>
                                                    <?php echo $cat->cat_name?>
                                                </option>
                                           <?php }
                                        ?>
                                    </select>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                                    </div>
                                    <?php echo  isset($data['errCat']) ?  '<div class="invalid-feedback">'.$data['errCat'].'</div>' : '' ?>
                                </div>

                                <div class="input-group mb-3">
                                    
                                    <select class="custom-select <?php echo  isset($data['errMan']) ?  'is-invalid' : '' ?>" id="inputGroupSelect01" name='man'>
                                        <option value ='Choose...' >Choose...</option>
                                    <?php 
                                            foreach ($data['man'] as $man) { ?>
                                               <option  value="<?php echo $man->man_id?>" 
                                               <?php echo $man->man_id==$data['product']->man ? 'selected':''?>
                                                >
                                                    <?php echo $man->man_name?>
                                                </option>
                                           <?php }
                                        ?>
                                    </select>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Brand</label>
                                    </div>
                                    <?php echo  isset($data['errMan']) ?  '<div class="invalid-feedback">'.$data['errMan'].'</div>' : '' ?>
                                </div>

                                <div class="from-group mb-2">
                                    <textarea 
                                        name="description" 
                                        placeholder="Enter product description" 
                                        class="form-control <?php echo  isset($data['errDes']) ?  'is-invalid' : '' ?>"
                                    ><?php echo $data['product']->description?></textarea>
                                    <?php echo  isset($data['errDes']) ?  '<div class="invalid-feedback">'.$data['errDes'].'</div>' : '' ?>
                                </div>
                                <input value='<?php echo $data['product']->product_id?>' type="hidden" name="product_id">
                                <div class="form-group">
                                <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                                    <a href='<?php echo URL ?>/products' class="btn btn-sm btn-secondary">
                                        <i class="fa fa-arrow-left"></i>
                                        Go Back
                                    </a>
                                    <input type="submit" name='editProduct' value='Düzenle' class="btn btn-success btn-sm">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>