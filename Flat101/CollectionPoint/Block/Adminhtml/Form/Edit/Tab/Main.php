<?php
namespace Flat101\CollectionPoint\Block\Adminhtml\Form\Edit\Tab;

class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Magento\Framework\Data\FormFactory
     */
    protected $_formFactory;

    /**
     * @var \Flat101\CollectionPoint\Model\ShippingMethods
     */
    protected $_shippingMethods;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \Flat101\CollectionPoint\Model\ShippingMethods $shippingMethods
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Flat101\CollectionPoint\Model\ShippingMethods $shippingMethods,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_formFactory = $formFactory;
        $this->_shippingMethods = $shippingMethods;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Main
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('form_post');
        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Collection Point Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );
        $fieldset->addField(
            'address',
            'text',
            [
                'name' => 'address',
                'label' => __('Address'),
                'title' => __('Address'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );
        $fieldset->addField(
            'locality',
            'text',
            [
                'name' => 'locality',
                'label' => __('Locality'),
                'title' => __('Locality'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );
        $fieldset->addField(
            'latitude',
            'text',
            [
                'label' => __('Latitude'),
                'title' => __('Latitude'),
                'name' => 'latitude',
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );
        $fieldset->addField(
            'longitude',
            'text',
            [
                'label' => __('Longitude'),
                'title' => __('Longitude'),
                'name' => 'longitude',
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );
        $fieldset->addField(
            'shipping_method',
            'select',
            [
                'label' => __('Shipping Method'),
                'title' => __('Shipping Method'),
                'name' => 'shipping_method',
                'required' => true,
                'options' => $this->_shippingMethods->getAllOptions(),
                'disabled' => $isElementDisabled,
            ]
        );
        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('General');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return false
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @param $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
