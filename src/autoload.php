<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'brera\\poc\\datapoolreader' => '/KeyValue/DataPoolReader.php',
                'brera\\poc\\datapoolwriter' => '/KeyValue/DataPoolWriter.php',
                'brera\\poc\\defaulthttpresponse' => '/DefaultHttpResponse.php',
                'brera\\poc\\domainevent' => '/DomainEvent.php',
                'brera\\poc\\domaineventconsumer' => '/DomainEventConsumer.php',
                'brera\\poc\\domaineventhandler' => '/DomainEventHandler.php',
                'brera\\poc\\domaineventhandlerfailedmessage' => '/DomainEventHandlerFailedMessage.php',
                'brera\\poc\\domaineventhandlerlocator' => '/DomainEventHandlerLocator.php',
                'brera\\poc\\domaineventqueue' => '/Queue/DomainEventQueue.php',
                'brera\\poc\\factory' => '/Factory.php',
                'brera\\poc\\factorytrait' => '/FactoryTrait.php',
                'brera\\poc\\failedtoreadfromdomaineventqueuemessage' => '/FailedToReadFromDomainEventQueueMessage.php',
                'brera\\poc\\frontendfactory' => '/FrontendFactory.php',
                'brera\\poc\\httpgetrequest' => '/Http/HttpGetRequest.php',
                'brera\\poc\\httppostrequest' => '/Http/HttpPostRequest.php',
                'brera\\poc\\httprequest' => '/Http/HttpRequest.php',
                'brera\\poc\\httprequesthandler' => '/Http/HttpRequestHandler.php',
                'brera\\poc\\httpresponse' => '/Http/HttpResponse.php',
                'brera\\poc\\httprouter' => '/Http/HttpRouter.php',
                'brera\\poc\\httprouterchain' => '/Http/HttpRouterChain.php',
                'brera\\poc\\httpsurl' => '/Http/HttpsUrl.php',
                'brera\\poc\\httpurl' => '/Http/HttpUrl.php',
                'brera\\poc\\inmemorydomaineventqueue' => '/Queue/InMemoryDomainEventQueue.php',
                'brera\\poc\\inmemorykeyvaluestore' => '/KeyValue/InMemoryKeyValueStore.php',
                'brera\\poc\\inmemorylogger' => '/InMemoryLogger.php',
                'brera\\poc\\inmemoryproductrepository' => '/Product/InMemoryProductRepository.php',
                'brera\\poc\\integrationtestfactory' => '/IntegrationTestFactory.php',
                'brera\\poc\\keynotfoundexception' => '/KeyValue/KeyNotFoundException.php',
                'brera\\poc\\keyvaluestore' => '/KeyValue/KeyValueStore.php',
                'brera\\poc\\keyvaluestorekeygenerator' => '/KeyValue/KeyValueStoreKeyGenerator.php',
                'brera\\poc\\logger' => '/Logger.php',
                'brera\\poc\\logmessage' => '/LogMessage.php',
                'brera\\poc\\masterfactory' => '/MasterFactory.php',
                'brera\\poc\\masterfactorytrait' => '/MasterFactoryTrait.php',
                'brera\\poc\\nomasterfactorysetexception' => '/NoMasterFactorySetException.php',
                'brera\\poc\\pocmasterfactory' => '/PoCMasterFactory.php',
                'brera\\poc\\pocproductprojector' => '/PoCProductProjector.php',
                'brera\\poc\\pocproductrenderer' => '/Renderer/PoCProductRenderer.php',
                'brera\\poc\\pocshop' => '/PoCShop.php',
                'brera\\poc\\product' => '/Product/Product.php',
                'brera\\poc\\productcreateddomainevent' => '/ProductCreatedDomainEvent.php',
                'brera\\poc\\productcreateddomaineventhandler' => '/ProductCreatedDomainEventHandler.php',
                'brera\\poc\\productdetailhtmlpage' => '/ProductDetailHtmlPage.php',
                'brera\\poc\\productid' => '/Product/ProductId.php',
                'brera\\poc\\productnotfoundexception' => '/Product/ProductNotFoundException.php',
                'brera\\poc\\productrenderer' => '/Renderer/ProductRenderer.php',
                'brera\\poc\\productrepository' => '/Product/ProductRepository.php',
                'brera\\poc\\productseourlrouter' => '/ProductSeoUrlRouter.php',
                'brera\\poc\\shop' => '/Shop.php',
                'brera\\poc\\singleinstanceregistry' => '/SingleInstanceRegistry.php',
                'brera\\poc\\singleinstanceregistrytrait' => '/SingleInstanceRegistryTrait.php',
                'brera\\poc\\sku' => '/Product/Sku.php',
                'brera\\poc\\unabletorouterequestexception' => '/Http/UnableToRouteRequestException.php',
                'brera\\poc\\undefinedfactorymethodexception' => '/Http/UndefinedFactoryMethodException.php',
                'brera\\poc\\unknownprotocolexception' => '/Http/UnknownProtocolException.php',
                'brera\\poc\\unsupportedrequestmethodexception' => '/Http/UnsupportedRequestMethodException.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
