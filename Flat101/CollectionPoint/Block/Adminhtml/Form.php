<?php
namespace Flat101\CollectionPoint\Block\Adminhtml;

class Form extends \Magento\Backend\Block\Widget\Container
{
    protected $_template = 'form/collectionPoints.phtml';

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return Form
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        $this->buttonList->add(
            'primary_add_new',
            [
                'label' => __('Add New Collection Point'),
                'class' => 'primary',
                'onclick' => "setLocation('" . $this->_getCreateUrl() . "')"
            ]
        );

        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('Flat101\CollectionPoint\Block\Adminhtml\Form\Grid', 'collectionpoint.grid')
        );
        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl(
            'collectionpoint/*/new'
        );
    }

    /**
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
