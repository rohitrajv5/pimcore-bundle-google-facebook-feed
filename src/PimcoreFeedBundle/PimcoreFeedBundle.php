<?php

namespace PimcoreFeedBundle\PimcoreFeedBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;

class PimcoreFeedBundle extends AbstractPimcoreBundle
{
    public function getJsPaths()
    {
        return [
            '/bundles/pimcorefeed/js/pimcore/startup.js'
        ];
    }
}