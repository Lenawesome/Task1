<?php
 
namespace Lenawesome\MyModule\Plugin\CheckoutCart;
 
class Image
{
    public function afterGetImage($item, $result)
    {
     if(YOUR_CONDITION) {
     $result->setImageUrl( YOUR_IMAGE_URL );
     }
     return $result;
    }
}