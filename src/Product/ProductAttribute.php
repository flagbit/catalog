<?php

namespace Brera\Product;

use Brera\Attribute;

class ProductAttribute implements Attribute
{
	/**
	 * @var string
	 */
	private $code;

	/**
	 * @var array
	 */
	private $environment;

	/**
	 * @var string
	 */
	private $value;

	/**
	 * @param string $code
	 * @param string $value
	 * @param array $environmentData
	 */
	private function __construct($code, $value, array $environmentData = [])
	{
		$this->code = $code;
		$this->environment = $environmentData;
		$this->value = $value;
	}

	/**
	 * @param array $node
	 * @return ProductAttribute
	 */
	public static function fromArray(array $node)
	{
		return new self($node['nodeName'], self::getValueRecursive($node['value']), $node['attributes']);
	}

	/**
	 * @param $nodeValue
	 * @return string|ProductAttributeList
	 */
	public static function getValueRecursive($nodeValue)
	{
		if (!is_array($nodeValue)) {
			return $nodeValue;
		}

		$list = new ProductAttributeList();

		foreach ($nodeValue as $node) {
			$list->add(new self($node['nodeName'], self::getValueRecursive($node['value']), $node['attributes']));
		}

		return $list;
	}

	/**
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @param string $codeExpectation
	 * @return bool
	 */
	public function isCodeEqualsTo($codeExpectation)
	{
		return $codeExpectation == $this->code;
	}

	/**
	 * @return string|ProductAttributeList
	 */
	public function getValue()
	{
		return $this->value;
	}
}
