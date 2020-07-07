<?php

namespace PimcoreFeedBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use PimcoreFeedBundle\Service\Feed;
use PimcoreFeedBundle\Service\Item;
use PimcoreFeedBundle\Service\FacebookProductItem;
use PimcoreFeedBundle\Service\SimpleXMLElement;
use PimcoreFeedBundle\Service\Channel;
use Pimcore\Model\DataObject;

class DefaultController extends FrontendController
{
    const BASE_URL = "YOUR URL";
    const CHANNEL_TITLE = "YOUR TITLE";
    
    public function defaultAction(Request $request)
    {        
        $products = new DataObject\Product\Listing();        
        $products =  $products->load();        
        header ("Content-Type:text/xml");        
        $feed = new Feed();
        $channel = new Channel();
        $channel
            ->title(CHANNEL_TITLE)
            ->description(BASE_URL)
            ->url(BASE_URL.'/google-feed')
            ->appendTo($feed);
        $item = new Item();
        foreach($products as $product)
        {           
            $item
                ->title($product->getTitle())
                ->description($product->getDescription())
                ->url($product->getImageUrl())
                ->enclosure($product->getImageUrl(), 4889, 'image/jpeg')
                ->appendTo($channel);
        } 
        echo $feed;                      
    }


    public function facebookFeedAction()
    {
        header ("Content-Type:text/xml"); 
        $feed = new Feed();
        $channel = new Channel();
        $channel
            ->title(CHANNEL_TITLE)
            ->description(BASE_URL)
            ->url(BASE_URL.'/facebook-feed')
            ->appendTo($feed);

        // Product feed item
        $item = new FacebookProductItem();
        $products = new DataObject\Product\Listing();        
        $products =  $products->load();        
        foreach($products as $product)
        {
            $item
                ->id($product->getId())
                ->title($product->getTitle())
                ->description($product->getDescription())
                ->url(BASE_URL.$product->getHandle())
                ->availability('in stock') 
                ->condition('new') 
                ->googleProductCategory('Apparel & Accessories > Clothing > Underwear & Socks')
                ->imageLink($product->getImageUrl())
                ->brand($product->getBrand())             
                ->appendTo($channel);
        } 
        echo $feed; 
        
    }

}
