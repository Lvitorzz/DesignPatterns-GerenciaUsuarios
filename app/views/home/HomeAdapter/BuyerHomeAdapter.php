<?php
    class BuyerHomeAdapter implements HomeAdapter {
        private $buyerHome;
    
        public function __construct(BuyerHome $buyerHome) {
            $this->buyerHome = $buyerHome;
        }
    
        public function displayHome() {
            $this->buyerHome->showBuyerHome();
        }
    }
?>