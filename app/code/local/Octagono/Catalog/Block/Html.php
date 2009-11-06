<?php
class Octagono_Mage_Page_Block_Html extends Mage_Page_Block_Html {

    public function getFeaturedProductHtml() {
        return $this->getBlockHtml('product_featured');
    }
}
?>

