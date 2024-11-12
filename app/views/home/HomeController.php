<?php 
    $userType = $_SESSION['userType'];

    $menu = null;

    if ($userType === 'vendedor') {
        $sellerMenu = new SellerHome();
        $menu = new SellerHomeAdapter($sellerHome);
    } elseif ($userType === 'comprador') {
        $buyerMenu = new BuyerHome();
        $menu = new BuyerHomeAdapter($buyerHome);
    }

    $menu->displayHome();

?>