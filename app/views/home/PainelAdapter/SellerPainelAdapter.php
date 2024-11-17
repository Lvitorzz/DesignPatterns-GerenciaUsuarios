<?php 
class SellerPainelAdapter implements PainelAdapter {
    private $sellerPainel;

    public function __construct(SellerPainel $sellerPainel) {
        $this->sellerPainel = $sellerPainel;
    }

    public function showPainel() {
        $this->sellerPainel->show();
    }
}
?>