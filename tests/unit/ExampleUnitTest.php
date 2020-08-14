<?php
/**
 * Rename Multibyte Filename plugin for Craft CMS 3.x
 *
 * Rename a multibyte character filename, such as Japanese, Chinese, Korean, and so on, when assets are uploaded.
 *
 * @link      https://bit-part.net
 * @copyright Copyright (c) 2020 bit part LLC
 */

namespace bitpart\renamemultibytefilenametests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use bitpart\renamemultibytefilename\RenameMultibyteFilename;

/**
 * ExampleUnitTest
 *
 *
 * @author    bit part LLC
 * @package   RenameMultibyteFilename
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            RenameMultibyteFilename::class,
            RenameMultibyteFilename::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
