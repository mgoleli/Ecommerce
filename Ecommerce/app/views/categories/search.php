
        <?php if($data['categories'] >  0){  ?>
        <table class="table table-dark table-responsive-md searched">
            <thead>
                <tr>
                    <th>Seri</th>
                    <th>Ad</th>
                    <th>Oluşturucu</th>
                    <th>Durum</th>
                    <th>Aksiyonlar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                

                
                $i = 0;
                    foreach ( $data['categories'] as $cat) { $i++ ?>                        
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>
                            <a href="<?php echo URL ?>/categories/show/<?php echo $cat->cat_id?>" class="text-danger">
                                <?php echo $cat->cat_name ?>
                            </a>
                        </td>
                        <td><?php echo $cat->creator ?></td>
                            <td>
                                <a href="<?php echo URL ?>/categories/<?php echo $cat->active == 0 ? 'activate':'inActivate'?>/<?php echo $cat->cat_id ?>">
                                    <?php echo $cat->active == 0 ? '<i class="fa fa-thumbs-down text-secondary"></i>':'<i class="fa fa-thumbs-up  text-success"></i>' ?>
                                </a>
                            </td>
                        <td>
                        <form class='d-inline' action="<?php echo URL ?>/categories/delete/<?php echo $cat->cat_id?>" method='GET'>
                            <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                            <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                        </form>
                            <a href="<?php echo URL ?>/categories/edit/<?php echo $cat->cat_id?>" class="btn btn-info btn-sm py-0"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                <?php } 
                
                ?>
            </tbody>
        </table>
    <?php  }else{?>
    <p class="text-center text-white pt-3 empty"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no results</p>
    <?php  }?>
    

