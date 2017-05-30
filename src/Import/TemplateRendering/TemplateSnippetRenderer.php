<?php

declare(strict_types=1);

namespace LizardsAndPumpkins\Import\TemplateRendering;

use LizardsAndPumpkins\Context\Context;
use LizardsAndPumpkins\Context\ContextSource;
use LizardsAndPumpkins\Import\TemplateRendering\BlockRenderer;
use LizardsAndPumpkins\DataPool\KeyGenerator\SnippetKeyGenerator;
use LizardsAndPumpkins\Import\SnippetRenderer;
use LizardsAndPumpkins\DataPool\KeyValueStore\Snippet;
use LizardsAndPumpkins\ProductListing\Import\TemplateRendering\TemplateProjectionData;

class TemplateSnippetRenderer implements SnippetRenderer
{
    /**
     * @var SnippetKeyGenerator
     */
    private $snippetKeyGenerator;

    /**
     * @var BlockRenderer
     */
    private $blockRenderer;

    /**
     * @var ContextSource
     */
    private $contextSource;

    public function __construct(
        SnippetKeyGenerator $snippetKeyGenerator,
        BlockRenderer $blockRenderer,
        ContextSource $contextSource
    ) {
        $this->snippetKeyGenerator = $snippetKeyGenerator;
        $this->blockRenderer = $blockRenderer;
        $this->contextSource = $contextSource;
    }

    /**
     * @param TemplateProjectionData $dataToRender
     * @return Snippet[]
     */
    public function render(TemplateProjectionData $dataToRender): array
    {
        return array_map(function (Context $context) use ($dataToRender) {
            return $this->renderProductListingPageSnippetForContext($dataToRender, $context);
        }, $this->contextSource->getAllAvailableContextsWithVersionApplied($dataToRender->getDataVersion()));
    }

    private function renderProductListingPageSnippetForContext(
        TemplateProjectionData $dataToRender,
        Context $context
    ): Snippet {
        $content = $this->blockRenderer->render($dataToRender, $context);
        $key = $this->snippetKeyGenerator->getKeyForContext($context, []);

        return Snippet::create($key, $content);
    }
}
