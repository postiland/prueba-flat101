<?php
namespace Flat101\CollectionPoint\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->getBlock('collectionpoint');
        $this->_view->renderLayout();
    }
}
