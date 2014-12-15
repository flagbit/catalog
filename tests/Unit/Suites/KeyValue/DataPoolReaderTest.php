<?php

namespace Brera\PoC\KeyValue;

use Brera\PoC\Product\ProductId;

require_once __DIR__ . '/AbstractDataPool.php';

/**
 * @covers \Brera\PoC\KeyValue\DataPoolReader
 * @uses \Brera\PoC\Product\ProductId
 * @uses \Brera\PoC\Http\HttpUrl
 * @uses \Brera\PoC\Product\PoCSku
 */
class DataPoolReaderTest extends AbstractDataPool
{
    /**
     * @var DataPoolReader
     */
    private $dataPoolReader;

    protected function setUp()
    {
	    parent::setUp();

        $this->dataPoolReader = new DataPoolReader($this->stubKeyValueStore, $this->stubKeyGenerator);
    }

    /**
     * @test
     */
    public function itShouldReturnASnippetIfItExists()
    {
        $testValue = '<p>html</p>';
        $testKey = 'test';
        
        $this->addGetMethodToStubKeyValueStore($testValue);

        $this->assertEquals($testValue, $this->dataPoolReader->getSnippet($testKey));
    }

    /**
     * @test
     */
    public function shouldReturnPoCProductHtmlBasedOnKeyFromKeyValueStorage()
    {
        $value = '<p>html</p>';
        $productId = $this->getStubProductId();

	    $this->addStubMethodToStubKeyGenerator('createPoCProductHtmlKey');
	    $this->addGetMethodToStubKeyValueStore($value);

        $html = $this->dataPoolReader->getPoCProductHtml($productId);

        $this->assertEquals($value, $html);
    }

    /**
     * @test
     */
    public function itShouldReturnProductIdBySeoUrl()
    {
        $value = 'test';
	    $url = $this->getDummyUrl();

	    $this->addStubMethodToStubKeyGenerator('createPoCProductSeoUrlToIdKey');
	    $this->addGetMethodToStubKeyValueStore($value);

        $productId = $this->dataPoolReader->getProductIdBySeoUrl($url);

        $this->assertEquals($value, $productId);
	    $this->assertInstanceOf(ProductId::class, $productId);
    }

    /**
     * @test
     */
    public function itShouldReturnIfTheSeoUrlKeyExists()
    {
	    $url = $this->getDummyUrl();

	    $this->addStubMethodToStubKeyGenerator('createPoCProductSeoUrlToIdKey');
	    $this->addHasMethodToStubKeyValueStore(true);

        $this->assertTrue($this->dataPoolReader->hasProductSeoUrl($url));
    }
}
