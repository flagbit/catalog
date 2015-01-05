<?php

namespace Brera\Api;

use Brera\Http\HttpRequestHandler;

/**
 * @covers Brera\Api\ApiRequestHandlerChain
 */
class ApiRequestHandlerChainTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var ApiRequestHandlerChain
	 */
	private $requestHandlerChain;

	protected function setUp()
	{
		$this->requestHandlerChain = new ApiRequestHandlerChain();
	}

	/**
	 * @test
	 */
	public function itShouldReturnARequestHandler()
	{
		$requestHandlerCode = 'foo';

		$stubApiRequestHandler = $this->getMock(HttpRequestHandler::class, ['process']);

		$this->requestHandlerChain->register($requestHandlerCode, $stubApiRequestHandler);
		$result = $this->requestHandlerChain->getApiRequestHandler($requestHandlerCode);

		$this->assertSame($stubApiRequestHandler, $result);
	}

	/**
	 * @test
	 */
	public function itShouldReturnNullIfNoApiRequestHandlerIsFound()
	{
		$result = $this->requestHandlerChain->getApiRequestHandler('foo');

		$this->assertNull($result);
	}
} 
