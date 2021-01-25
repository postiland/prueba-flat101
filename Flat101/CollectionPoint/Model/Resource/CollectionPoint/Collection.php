<?php
namespace Flat101\CollectionPoint\Model\Resource\CollectionPoint;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Flat101\CollectionPoint\Model\CollectionPoint', 'Flat101\CollectionPoint\Model\Resource\CollectionPoint');
    }


}
