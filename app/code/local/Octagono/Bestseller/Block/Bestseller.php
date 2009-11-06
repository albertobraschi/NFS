<?php

class Octagono_Bestseller_Block_Bestseller extends Mage_Core_Block_Template
{

	public function fetchBestsellers($totalToFetch = 6)
	{
		$bestsellers = Mage::getModel('bestseller/bestseller');
		$bestsellers = $bestsellers->getBestsellers($totalToFetch);
		return $bestsellers;
	}
}

