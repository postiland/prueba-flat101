<?php
namespace Flat101\CollectionPoint\Block\Adminhtml\Form;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Flat101\CollectionPoint\Model\CollectionPointFactory
     */
    protected $_collectionPointFactory;

    /**
     * @var \Flat101\CollectionPoint\Model\ShippingMethods
     */
    protected $_shippingMethods;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Flat101\CollectionPoint\Model\CollectionPointFactory $collectionPointFactory
     * @param \Flat101\CollectionPoint\Model\ShippingMethods $shippingMethods
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Flat101\CollectionPoint\Model\CollectionPointFactory $collectionPointFactory,
        \Flat101\CollectionPoint\Model\ShippingMethods $shippingMethods,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_collectionPointFactory = $collectionPointFactory;
        $this->_shippingMethods = $shippingMethods;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('post_filter');
    }

    protected function _prepareCollection()
    {
        $collection = $this->_collectionPointFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return Grid
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
            ]
        );
        $this->addColumn(
            'address',
            [
                'header' => __('Address'),
                'index' => 'address',
            ]
        );
        $this->addColumn(
            'locality',
            [
                'header' => __('Locality'),
                'index' => 'locality',
            ]
        );
        $this->addColumn(
            'latitude',
            [
                'header' => __('Latitude'),
                'index' => 'latitude',
            ]
        );
        $this->addColumn(
            'longitude',
            [
                'header' => __('Longitude'),
                'index' => 'longitude',
            ]
        );
        $this->addColumn(
            'shipping_method',
            [
                'header' => __('Shipping Method'),
                'index' => 'shipping_method',
                'type' => 'options',
                'options' => $this->_shippingMethods->getAllOptions()
            ]
        );
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'collectionpoint/*/edit',
                        ],
                        'field' => 'id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );
        $this->addColumn(
            'delete',
            [
                'header' => __('Delete'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Delete'),
                        'url' => [
                            'base' => 'collectionpoint/*/delete',
                        ],
                        'field' => 'id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('collectionpoint/*/grid', ['_current' => true]);
    }

    /**
     * @param \Magento\Catalog\Model\Product|\Magento\Framework\DataObject $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'collectionpoint/*/edit',
            ['id' => $row->getId()]
        );
    }
}
