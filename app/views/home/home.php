<?php
    require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/HomeAdapter/HomeAdapter.php';
    require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/HomeAdapter/BuyerHome.php';
    require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/HomeAdapter/SellerHome.php';
    require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/HomeAdapter/BuyerHomeAdapter.php';
    require_once 'C:/xampp/htdocs/GerenciaUsuario/app/views/home/HomeAdapter/SellerHomeAdapter.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container-home">
        <h1>Bem-vindo, <?php echo $_SESSION['user_name']; ?>!</h1>
        
        <?php
        $userType = $_SESSION['userType'];

        $menu = null;

        if ($userType === 'vendedor') {
            $sellerHome = new SellerHome();
            $menu = new SellerHomeAdapter($sellerHome);
        } elseif ($userType === 'comprador') {
            $buyerHome = new BuyerHome();
            $menu = new BuyerHomeAdapter($buyerHome);
        }

        $menu->displayHome();
        ?>
    </div>
</body>
</html>
