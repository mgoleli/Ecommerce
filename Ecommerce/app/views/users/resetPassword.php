<?php require_once ROOT ."/views/inc/header.php" ?>
    <div class="  mt-4">
        <div class="row">
            <div class="col-10 col-md-8 m-auto">
            <?php
            
            echo  isset($data['err']) ?  '<div class="text-danger">'.$data['err'].'</div>' : '' 
             ?>
            <h5  class='text-center mb-4'>Parola</h5>
            <form method="POST" action='<?php echo URL ?>/users/resetPassword/<?php echo $data["vkey"] ?>'>
                <div class="input-group">
                    <input type="password"  name='password' class="form-control <?php echo  isset($data['errPassword']) ?  'is-invalid' : '' ?>" placeholder='Parola giriniz'>
                    
                    <div class="input-group-btn">
                        <input type="submit" name='newPassword' value="New Password" class="btn btn-success">
                    </div>
                    <p><?php echo  isset($data['errPassword']) ?  '<div class="invalid-feedback">'.$data['errPassword'].'</div>' : '' ?></p>
                </div>
                
            </form>
            <small class="text-muted">Yeni şifreyi yazın ve girişte bu şifreye basın.</small>
            </div>
        </div>
    </div>
<?php require_once ROOT ."/views/inc/footer.php" ?>
