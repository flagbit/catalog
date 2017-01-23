<?php

declare(strict_types=1);

namespace LizardsAndPumpkins;

use LizardsAndPumpkins\Http\HttpHeaders;
use LizardsAndPumpkins\Http\HttpRequest;
use LizardsAndPumpkins\Http\HttpRequestBody;
use LizardsAndPumpkins\Http\HttpUrl;
use LizardsAndPumpkins\Messaging\MessageReceiver;
use LizardsAndPumpkins\Messaging\Queue\Message;

class CatalogImportApiTest extends AbstractIntegrationTest
{
    private function getNextMessageFromQueue(Messaging\Queue $queue): Message
    {
        $receiver = new class implements MessageReceiver {
            public $message;
            public function receive(Message $message)
            {
                $this->message = $message;
            }
        };
        $queue->consume($receiver, 1);
        return $receiver->message;
    }
    
    public function testV1CatalogImportHandlerPlacesImportCommandsIntoQueue()
    {
        $httpUrl = HttpUrl::fromString('http://example.com/api/catalog_import');
        $httpHeaders = HttpHeaders::fromArray([
            'Accept' => 'application/vnd.lizards-and-pumpkins.catalog_import.v1+json'
        ]);
        $httpRequestBodyString = json_encode(['fileName' => 'catalog.xml']);
        $httpRequestBody = new HttpRequestBody($httpRequestBodyString);
        $request = HttpRequest::fromParameters(HttpRequest::METHOD_PUT, $httpUrl, $httpHeaders, $httpRequestBody);

        $factory = $this->prepareIntegrationTestMasterFactoryForRequest($request);
        $implementationSpecificFactory = $this->getIntegrationTestFactory($factory);
        
        $commandQueue = $factory->getCommandMessageQueue();
        $this->assertEquals(0, $commandQueue->count());

        $website = new InjectableDefaultWebFront($request, $factory, $implementationSpecificFactory);
        $response = $website->processRequest();

        $message = $this->getNextMessageFromQueue($commandQueue);
        $this->assertSame('import_catalog', $message->getName());
        $this->assertSame('-1', $message->getMetadata()['data_version']);
        
        $this->assertSame(202, $response->getStatusCode());
        $this->assertSame('', $response->getBody());
    }
    
    public function testV2CatalogImportHandlerPlacesImportCommandsIntoQueue()
    {
        $httpUrl = HttpUrl::fromString('http://example.com/api/catalog_import');
        $httpHeaders = HttpHeaders::fromArray([
            'Accept' => 'application/vnd.lizards-and-pumpkins.catalog_import.v2+json'
        ]);
        $httpRequestBodyString = json_encode([
            'fileName' => 'catalog.xml',
            'dataVersion' => 'foo-123'
        ]);
        $httpRequestBody = new HttpRequestBody($httpRequestBodyString);
        $request = HttpRequest::fromParameters(HttpRequest::METHOD_PUT, $httpUrl, $httpHeaders, $httpRequestBody);

        $factory = $this->prepareIntegrationTestMasterFactoryForRequest($request);
        $implementationSpecificFactory = $this->getIntegrationTestFactory($factory);
        
        $commandQueue = $factory->getCommandMessageQueue();
        $this->assertEquals(0, $commandQueue->count());

        $website = new InjectableDefaultWebFront($request, $factory, $implementationSpecificFactory);
        $response = $website->processRequest();

        $message = $this->getNextMessageFromQueue($commandQueue);
        $this->assertSame('import_catalog', $message->getName());
        $this->assertSame('foo-123', $message->getMetadata()['data_version']);
        
        $this->assertSame(202, $response->getStatusCode());
        $this->assertSame('', $response->getBody());
    }
}
