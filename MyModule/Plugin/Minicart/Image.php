<?php
 
namespace Lenawesome\MyModule\Plugin\Minicart;
 
class Image
{
    protected $_data;
    protected $_productRepositoryFactory;
    protected $_imageHelper;
    public function __construct(
        \Lenawesome\MyModule\Helper\Data $data,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryFactory,
        \Magento\Catalog\Helper\Image $imageHelper
    ){
        $this->_data = $data;
        $this->_productRepositoryFactory = $productRepositoryFactory;
        $this->_imageHelper = $imageHelper;
    }
    public function aroundGetItemData($subject, $proceed, $item)
    {
        $result = $proceed($item);
         if($this->_data->getGeneralConfig('enable')==1) {
            $productSKU =  $item->getProduct()->getSku();
            $product = $this->_productRepositoryFactory->get($productSKU);
            $imageUrl = $this->_imageHelper
            ->init($product, 'product_base_image')
            ->constrainOnly(TRUE)
            ->keepTransparency(TRUE)
            ->keepFrame(FALSE)->resize(600,600)->getUrl();
                $result['product_image']['src'] = $imageUrl;
             }
            return $result;
    }
}