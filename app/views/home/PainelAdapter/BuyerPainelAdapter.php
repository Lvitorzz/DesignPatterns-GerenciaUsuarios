<?php 
class BuyerPainelAdapter implements PainelAdapter {
    private $buyerPainel;

    public function __construct(BuyerPainel $buyerPainel) {
        $this->buyerPainel = $buyerPainel;
    }

    public function showPainel() {
        $this->buyerPainel->show();
    }
}
?>