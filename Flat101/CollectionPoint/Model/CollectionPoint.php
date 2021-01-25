<?php
namespace Flat101\CollectionPoint\Model;

class CollectionPoint extends \Magento\Framework\Model\AbstractModel
{
	public function _construct()
	{
	    $this->_init('Flat101\CollectionPoint\Model\Resource\CollectionPoint');
	}
}
