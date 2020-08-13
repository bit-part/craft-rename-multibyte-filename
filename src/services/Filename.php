<?php
/**
 * Rename Multibyte Filename plugin for Craft CMS 3.x
 *
 * Rename a multibyte character filename, such as Japanese, Chinese, Korean, and so on, when an asset is uploaded.
 *
 * @link      https://bit-part.net
 * @copyright Copyright (c) 2020 bit part LLC
 */

namespace bitpart\renamemultibytefilename\services;

use bitpart\renamemultibytefilename\RenameMultibyteFilename;

use Craft;
use craft\base\Component;

/**
 * Filename Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    bit part LLC
 * @package   RenameMultibyteFilename
 * @since     1.0.0
 */
class Filename extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     RenameMultibyteFilename::$plugin->filename->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (RenameMultibyteFilename::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
