<?php

namespace LizardsAndPumpkins\Renderer\Translation;

interface Translator
{
    /**
     * @param string $string
     * @return string
     */
    public function translate($string);
}
