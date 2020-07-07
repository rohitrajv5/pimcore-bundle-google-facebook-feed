pimcore.registerNS("pimcore.plugin.PimcoreFeedBundle");

pimcore.plugin.PimcoreFeedBundle = Class.create(pimcore.plugin.admin, {
    getClassName: function () {
        return "pimcore.plugin.PimcoreFeedBundle";
    },

    initialize: function () {
        pimcore.plugin.broker.registerPlugin(this);
    },

    pimcoreReady: function (params, broker) {
        // alert("PimcoreFeedBundle ready!");
    }
});

var PimcoreFeedBundlePlugin = new pimcore.plugin.PimcoreFeedBundle();
