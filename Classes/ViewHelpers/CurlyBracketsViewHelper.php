<?php

namespace EBT\ExtensionBuilder\ViewHelpers;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CurlyBracketsViewHelper extends AbstractViewHelper
{
    protected $escapeOutput = false;

    protected $escapeChildren = false;

    public function render()
    {
        return '{' . $this->renderChildren() . '}';
    }
}
