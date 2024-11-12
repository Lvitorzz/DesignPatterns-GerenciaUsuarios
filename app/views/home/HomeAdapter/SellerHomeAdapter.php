<?php
    class SellerHomeAdapter implements HomeAdapter {
        private $sellerHome;
    
        public function __construct(SellerHome $sellerHome) {
            $this->sellerHome = $sellerHome;
        }
    
        public function displayHome() {
            $this->sellerHome->showSellerHome();
        }
    }
?>