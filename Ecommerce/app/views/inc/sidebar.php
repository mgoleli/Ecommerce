
<nav class="navbar navbar-expand-sm navbar-light bg-light">
<div class="container ">
      <a class="navbar-brand" href="<?php echo URL ?>/admins/dashboard">Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault2" aria-controls="navbarsExampleDefault2" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault2">
        <ul class="navbar-nav mr-auto">
          
           <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Kategoriler</a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">
                    <a class="dropdown-item" href="<?php echo URL ?>/categories">Tüm Kategoriler</a>
                    <a class="dropdown-item" href="<?php echo URL ?>/categories/add">Kategori ekle</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Markalar</a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">
                    <a class="dropdown-item" href="<?php echo URL ?>/manufactures">Tüm Markalar</a>
                    <a class="dropdown-item" href="<?php echo URL ?>/manufactures/add">Marka ekle</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="dropdown02" data-toggle="dropdown">Ürünler</a>
                <div class="dropdown-menu" aria-labelledby="dropdown02">
                    <a class="dropdown-item" href="<?php echo URL ?>/products">Tüm ürünler</a>
                    <a class="dropdown-item" href="<?php echo URL ?>/products/add">Ürün Ekle</a>
                </div>
            </li>

            <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL ?>/orders">Siparişler</a>
                </li>
    
        </ul>
      </div>
      </div>
    </nav>
    <div class="container all">

    <?php require_once ROOT ."/views/inc/messages.php" ?>
