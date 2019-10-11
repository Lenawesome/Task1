<?php
namespace Lenawesome\MyModule\Block;
use \Magento\Checkout\Helper\Cart as CartHelper;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSellersCollectionFactory;
class Product extends \Magento\Framework\View\Element\Template
{
    protected $_productRepository;
    protected $_cartHelper;
    protected $_productRepositoryFactory;
    protected $_productFactory;
    protected $_bestSeller;
    protected $_productCollection;

    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
    \Magento\Catalog\Api\ProductRepositoryInterfaceFactory $productRepositoryFactory,
    \Magento\Catalog\Model\ProductFactory $productFactory,
    CartHelper $cartHelper,
    BestSellersCollectionFactory $bestSeller,
    \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollection
    )
    {
        parent::__construct($context);
        $this->_productRepository = $productRepository;
        $this->_cartHelper = $cartHelper;
        $this->_productRepositoryFactory = $productRepositoryFactory;
        $this->_productFactory = $productFactory;
        $this->_bestSeller = $bestSeller;
        $this->_productCollection = $productCollection;
    }

    public function getProductById($productId){
        $product = $this->_productRepository->getById($productId);
        return $product;
    }
    public function getAddCartUrl($product){
        return $this->_cartHelper->getAddUrl($product);
    }
    public function getProductUrl($productId){
        return $this->_productFactory->create()->load($productId)->getProductUrl();
    }
    public function getBestSeller(){
        $productIds = [];
        $bestSellers = $this->_bestSeller->create()
            ->setPeriod('month');
        return $bestSellers;
    }
    public function getProductList(){
        return $this->_productCollection->create();
    }
}
