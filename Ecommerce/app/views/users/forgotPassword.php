<?php require_once ROOT ."/views/inc/header.php" ?>
    <div class="  mt-4">
        <div class="row">
            <div class="col-10 col-md-8 m-auto">
            <?php
            new Session();
            Session::success("check");
            echo  isset($data['err']) ?  '<div class="text-danger mt-2">'.$data['err'].'</div>' : '' 
             ?>
            <h5 class='text-center m-4'>E-mail</h5>
            <form method="POST" action='<?php echo URL ?>/users/forgotPassword'>
                <div class="input-group">
                    <input type="email" name='email' class="form-control" placeholder='E-mail'>
                    <div class="input-group-btn">
                        <input type="submit" name='forgotPassword' value="Gönder" class="btn btn-success">
                    </div>
                </div>
                <small class="text-muted">Size bir e-posta göndermek için e-postanızı girin, ardından yeni şifre almak için e-postanızı kontrol edin</small>
            </form>
            </div>
        </div>
    </div>
<?php //require_once ROOT ."/views/inc/footer.php" ?>