<?php

namespace Brera\Image;

/**
 * @covers \Brera\Image\ImageMagickResizeInstruction
 * @covers \Brera\Image\ResizeInstructionTrait
 */
class ImageMagickResizeInstructionTest extends AbstractResizeInstructionTest
{
    /**
     * @return string
     */
    protected function getResizeClassName()
    {
        return ImageMagickResizeInstruction::class;
    }
}
