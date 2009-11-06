<?php

class Octagono_Bestseller_Model_Bestseller
{
	public function getBestsellers($showTotal = 2)
	{
		// Array of arrays
		$_arrayOfBestsellers = $this->getArrayOfBestsellers($showTotal);

		// Array of Mage_Catalog_Model_Product
		$_bestsellers = array();

		if(count($_arrayOfBestsellers) > 0)
		{
			foreach ($_arrayOfBestsellers as $blueprint)
			{
				$_product = Mage::getModel('catalog/product');
				$_product->load($blueprint['entity_id']);


				/**
				 * NOTE: Default Mage_Catalog_Model_Product does not have some fields like "ordered_qty",
				 * by using "$_product->addData($blueprint)" we add those fields to object
				 */
				$_bestsellers[] = $_product->addData($blueprint);
			}
		}

		return $_bestsellers;
	}

	public function getArrayOfBestsellers($showTotal = 2)
	{

		// Select only visible products, the one that show in our store
		$visibility = array(
                      Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
                      Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
                  );

		$_arrayOfBestsellers = Mage::getResourceModel('reports/product_collection')
									->addAttributeToSelect('*')
									->addOrderedQty()
									->addAttributeToFilter('visibility', $visibility)
									->setOrder('ordered_qty', 'desc')
									->getSelect()->limit((int)$showTotal)->query();

		return $_arrayOfBestsellers;

		/**
		 	$_arrayOfBestsellers is an array of arrays like:

			Array
			(
			    [ordered_qty] => 7.0000
			    [entity_id] => 51
			    [entity_type_id] => 10
			    [attribute_set_id] => 42
			    [type_id] => simple
			    [sku] => 1111
			    [category_ids] => 22
			    [created_at] => 2007-08-28 16:25:46
			    [updated_at] => 2008-08-08 14:59:04
			    [has_options] => 0
			    [visibility] => 4
			)

			Array
			(
			    [ordered_qty] => 4.0000
			    [entity_id] => 53
			    [entity_type_id] => 10
			    [attribute_set_id] => 42
			    [type_id] => simple
			    [sku] => 1113
			    [category_ids] => 22
			    [created_at] => 2007-08-28 16:32:24
			    [updated_at] => 2008-08-08 14:59:40
			    [has_options] => 0
			    [visibility] => 4
			)

		 */
	}
}

