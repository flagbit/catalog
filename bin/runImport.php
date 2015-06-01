<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Brera\CommonFactory;
use Brera\Product\CatalogImportDomainEvent;
use Brera\PoCMasterFactory;
use Brera\RootTemplateChangedDomainEvent;
use Brera\SampleFactory;

$factory = new PoCMasterFactory();
$factory->register(new CommonFactory());
$factory->register(new SampleFactory());

$queue = $factory->getEventQueue();

$xml = file_get_contents(__DIR__ . '/../tests/shared-fixture/product-listing-root-snippet.xml');
$queue->add(new RootTemplateChangedDomainEvent($xml));

$xml = file_get_contents(__DIR__ . '/../tests/shared-fixture/catalog.xml');
$queue->add(new CatalogImportDomainEvent($xml));

$consumer = $factory->createDomainEventConsumer();
$numberOfMessages = 13;
$consumer->process($numberOfMessages);

$messages = $factory->getLogger()->getMessages();
if (count($messages)) {
    echo "Log message(s):\n";
    foreach ($messages as $message) {
        echo "\t" . $message;
        if (substr($message, -1) !== PHP_EOL) {
            echo PHP_EOL;
        }
    }
}
