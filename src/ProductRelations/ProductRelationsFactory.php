<?php

declare(strict_types=1);

namespace LizardsAndPumpkins\ProductRelations;

use LizardsAndPumpkins\ProductRelations\ContentDelivery\ProductRelationsApiV1GetRequestHandler;
use LizardsAndPumpkins\ProductRelations\ContentDelivery\ProductRelationsLocator;
use LizardsAndPumpkins\ProductRelations\ContentDelivery\ProductRelationsService;
use LizardsAndPumpkins\RestApi\ApiRequestHandlerLocator;
use LizardsAndPumpkins\Util\Factory\Factory;
use LizardsAndPumpkins\Util\Factory\FactoryWithCallbackTrait;
use LizardsAndPumpkins\Util\Factory\FactoryTrait;
use LizardsAndPumpkins\Util\Factory\FactoryWithCallback;
use LizardsAndPumpkins\Util\Factory\MasterFactory;

class ProductRelationsFactory implements FactoryWithCallback
{
    use FactoryWithCallbackTrait;

    public function createProductRelationsService(): ProductRelationsService
    {
        return new ProductRelationsService(
            $this->getMasterFactory()->createProductRelationsLocator(),
            $this->getMasterFactory()->createProductJsonService()
        );
    }

    public function createProductRelationsLocator(): ProductRelationsLocator
    {
        return new ProductRelationsLocator();
    }

    public function createProductRelationsApiV1GetRequestHandler(): ProductRelationsApiV1GetRequestHandler
    {
        return new ProductRelationsApiV1GetRequestHandler(
            $this->getMasterFactory()->createProductRelationsService(),
            $this->getMasterFactory()->createUrlToWebsiteMap(),
            $this->getMasterFactory()->createContextBuilder()
        );
    }

    public function factoryRegistrationCallback(MasterFactory $masterFactory)
    {
        $apiVersion = 1;

        /** @var ApiRequestHandlerLocator $apiRequestHandlerLocator */
        $apiRequestHandlerLocator = $masterFactory->getApiRequestHandlerLocator();
        $apiRequestHandlerLocator->register('get_products', $apiVersion, function () {
            return $this->getMasterFactory()->createProductRelationsApiV1GetRequestHandler();
        });
    }
}
