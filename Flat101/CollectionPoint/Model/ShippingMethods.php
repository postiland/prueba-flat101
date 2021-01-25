<?php
namespace Flat101\CollectionPoint\Model;

class ShippingMethods
{
    protected $scopeConfig;
    protected $shippingmodelconfig;

    public function __construct(
        \Magento\Shipping\Model\Config $shippingmodelconfig,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ){
        $this->shippingmodelconfig = $shippingmodelconfig;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    public function getActiveShippingMethod()
    {
        $shippings = $this->shippingmodelconfig->getActiveCarriers();
        $methods = array();
        foreach($shippings as $shippingCode => $shippingModel){
            if($carrierMethods = $shippingModel->getAllowedMethods()){
                foreach ($carrierMethods as $methodCode => $method){
                    $code = $shippingCode.'_'.$methodCode;
                    $carrierTitle = $this->scopeConfig->getValue('carriers/'. $shippingCode.'/title');
                    $methods[] = array('index'=>$code,'value'=>$carrierTitle);
                }
            }
        }
        return $methods;
    }

    /**
     * Retrieve option array with shipping method allowed
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];
        foreach ($this->getActiveShippingMethod() as $carrier) {
            $result[$carrier['index']] = $carrier['value'];
        }
        return $result;
    }
}
