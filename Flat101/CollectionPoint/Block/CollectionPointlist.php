<?php
namespace Flat101\CollectionPoint\Block;

use Magento\Framework\View\Element\Template;

class CollectionPointlist extends Template
{
    protected $_collectionPointFactory;

    protected $_storeManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Flat101\CollectionPoint\Model\CollectionPointFactory $collectionPointFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
     )
    {
        $this->_collectionPointFactory = $collectionPointFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
        $collection = $this->_collectionPointFactory->create()->getCollection();
        $this->setCollection($collection);
        $this->pageConfig->getTitle()->set(__('Collection Points List'));
    }

    /**
     * @return $this|CollectionPointlist
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'flat101.collectionpoint.record.pager'
            )->setCollection(
                $this->getCollection()
            );
            $this->setChild('pager', $pager);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBaseUrl()
    {
    return $this->_storeManager->getStore()->getBaseUrl();
    }
}
