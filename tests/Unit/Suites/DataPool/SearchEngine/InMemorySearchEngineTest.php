<?php

namespace Brera\DataPool\SearchEngine;

/**
 * @covers \Brera\DataPool\SearchEngine\InMemorySearchEngine
 * @covers \Brera\DataPool\SearchEngine\IntegrationTestSearchEngineAbstract
 * @uses   \Brera\DataPool\SearchEngine\SearchDocument
 * @uses   \Brera\DataPool\SearchEngine\SearchDocumentField
 * @uses   \Brera\DataPool\SearchEngine\SearchDocumentFieldCollection
 */
class InMemorySearchEngineTest extends AbstractSearchEngineTest
{
    /**
     * @return SearchEngine
     */
    protected function createSearchEngineInstance()
    {
        return new InMemorySearchEngine();
    }
}
