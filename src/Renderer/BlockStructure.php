<?php


namespace Brera\Renderer;

class BlockStructure
{
    /**
     * @var Block[]
     */
    private $blocks;

    /**
     * @var array[]
     */
    private $blockChildren = [];


    /**
     * @param string $parentName
     * @param string $childName
     * @return bool
     */
    public function hasChildBlock($parentName, $childName)
    {
        if (!array_key_exists($parentName, $this->blockChildren)) {
            return false;
        }
        if (!in_array($childName, $this->blockChildren[$parentName])) {
            return false;
        }
        return true;
    }

    /**
     * @param string $parentName
     * @param string $childName
     * @return string
     * @throws BlockIsNotAChildOfParentBlockException
     */
    public function getChildBlock($parentName, $childName)
    {
        if (!$this->hasChildBlock($parentName, $childName)) {
            throw new BlockIsNotAChildOfParentBlockException(sprintf(
                'The block "%s" is not a child of the parent block "%s"',
                $childName,
                $parentName
            ));
        }
        return $this->getBlock($childName);
    }

    /**
     * @param string $blockName
     * @return Block
     */
    public function getBlock($blockName)
    {
        if (!array_key_exists($blockName, $this->blocks)) {
            throw new BlockDoesNotExistException(sprintf('Block does not exist: "%s"', $blockName));
        }
        return $this->blocks[$blockName];
    }

    /**
     * @param string $parentName
     * @param Block $childBlockInstance
     */
    public function setParentBlock($parentName, Block $childBlockInstance)
    {
        if (!$this->hasBlock($parentName)) {
            throw new BlockDoesNotExistException(sprintf(
                'Parent block "%s" does not exist for block "%s"',
                $parentName,
                $childBlockInstance->getBlockName()
            ));
        }
        if (! $this->hasChildBlock($parentName, $childBlockInstance->getBlockName())) {
            $this->blockChildren[$parentName][] = $childBlockInstance->getBlockName();
        }
    }

    /**
     * @param string $blockName
     * @return bool
     */
    public function hasBlock($blockName)
    {
        return array_key_exists($blockName, $this->blocks);
    }

    /**
     * @param Block $blockInstance
     */
    public function addBlock(Block $blockInstance)
    {
        $this->blocks[$blockInstance->getBlockName()] = $blockInstance;
    }
}
