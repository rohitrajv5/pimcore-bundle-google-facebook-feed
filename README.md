# PimcoreFeedBundle

PimcoreFeedBundle use to generate feed from your product class

## Installation

Install this bundle using composer install
```bash
composer install rohitrajv5/pimcore-bundle-google-facebook-feed
```
Enable PimcoreFeedBundle bundle
```bash
bin/console pimcore:bundle:enable PimcoreFeedBundle
```
Install assets
```bash
bin/console assets:install web
```
use following packages in your controller
```bash
use PimcoreFeedBundle\Service\Feed;
use PimcoreFeedBundle\Service\Item;
use PimcoreFeedBundle\Service\FacebookProductItem;
use PimcoreFeedBundle\Service\SimpleXMLElement;
use PimcoreFeedBundle\Service\Channel;
```
Add following actions in your controller
```bash
    const BASE_URL = "YOUR URL";
    const CHANNEL_TITLE = "YOUR TITLE";
    
    public function googleFeedAction(Request $request)
    {        
        $products = new DataObject\Product\Listing(); // Search listing from your product class        
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
            /**
            You can call your own getter to map the values in array
            */
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
        $products = new DataObject\Product\Listing();  // Search listing from your product class         
        $products =  $products->load();        
        foreach($products as $product)
        {
            /**
            You can call your own getter to map the values in array
            */
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
```

# Document Changes!
Create 2 document as follows:

![alt text](https://i.postimg.cc/Dmk8NfQC/Screenshot-from-2020-07-07-15-13-22.png)

Set Controller & Action. Respectively for both documents

![alt text](https://i.postimg.cc/prnmk5jh/Screenshot-from-2020-07-07-15-14-15.png)

Save & Publish 

You are done !

# Navigate to Google & Facebook Feed urls!
    Google: http://[YOUR_APPLICATION_URL]/google-feed
    Facebook: http://[YOUR_APPLICATION_URL]/facebook-feed


# Facebook Feed:!
![alt text](https://i.postimg.cc/yY81VZxF/Screenshot-from-2020-07-07-15-17-45.png)

# Google Feed:!
![alt text](https://i.postimg.cc/7PVP8VHH/Screenshot-from-2020-07-07-15-18-03.png)

# Features!

  - Plugin will generate Facebook & Google Feeds
  - Public url will be directly accessible by Google & Facebook

License
----

GPL-3.0+




