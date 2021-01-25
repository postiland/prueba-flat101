<?php
namespace Flat101\CollectionPoint\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CollectionPoint extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('flat101_collection_points', 'id');
    }
}
