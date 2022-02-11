
<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>
    <div class="  text-center mt-4">

        <h5>Marka Yönetimi</h5>
        <input type="text" id='search_man' class="form-control w-50 mx-auto" placeholder="Search">
   
        <span class="float-right m-3">
            <a href="<?php echo URL ?>/manufactures/add">Yeni marka ekle +</a>
        </span>
        <?php if($data['manufactures'] ){  ?>
        <table class="table table-dark table-responsive-md searched">
            <thead>
                <tr>
                    <th>Seriler</th>
                    <th>Ad</th>
                    <th>Oluşturucu</th>
                    <th>Durum</th>
                    <th>Aksiyonlar</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                
                $i = 0;
                    foreach ( $data['manufactures'] as $man) { $i++ ?>                        
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>
                            <a href="<?php echo URL ?>/manufactures/show/<?php echo $man->man_id?>" class="text-danger">
                                <?php echo $man->man_name ?>
                            </a>
                        </td>
                        <td><?php echo $man->creator ?></td>
                            <td>
                                <a href="<?php echo URL ?>/manufactures/<?php echo $man->active == 0 ? 'activate':'inActivate'?>/<?php echo $man->man_id ?>">
                                    <?php echo $man->active == 0 ? '<i class="fa fa-thumbs-down text-secondary"></i>':'<i class="fa fa-thumbs-up  text-success"></i>' ?>
                                </a>
                            </td>
                        <td>
                        <form class='d-inline' action="<?php echo URL ?>/manufactures/delete/<?php echo $man->man_id?>" method='GET'>
                            <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                            <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                        </form>
                            <a href="<?php echo URL ?>/manufactures/edit/<?php echo $man->man_id?>" class="btn btn-info btn-sm py-0"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                <?php } 
                
                ?>
            </tbody>
        </table>
        <?php }else{?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span>Marka bulunamadı</p>
                    <?php  } ?>
    </div>


<?php require_once ROOT ."/views/inc/adminFooter.php" ?>