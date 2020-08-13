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
use craft\helpers\StringHelper;
use DateTime;

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
     *     RenameMultibyteFilename::$plugin->filename->rename()
     *
     * @param $asset
     * @return mixed
     */
    public function rename(&$asset, $hook)
    {
        $filename = $asset->getFilename(false);
        $length = strlen($filename);
        $mbLength = mb_strlen($filename);
        if ($length === $mbLength) {
            return true;
        }

        $settings = RenameMultibyteFilename::$plugin->getSettings();
        $filenameParts = [];

        // Format
        $filenameFormat = $settings->filenameFormat;
        switch ($filenameFormat) {
            case 'time':
                $now = new DateTime();
                $filenameParts[] = $now->format('YmsHis');
                break;
            case 'hash':
                $filenameParts[] = hash('md5', $filename);
                break;
            case 'id':
                $assetId = $asset->id;
                $filenameParts[] = $assetId;
                break;
        }
        
        // Volume Handle Name
        $addVolumeHandle = $settings->addVolumeHandle;
        $volumeHandle = $asset->volume->handle;
        if ($addVolumeHandle) {
            switch ($addVolumeHandle) {
                case 'before':
                    array_unshift($filenameParts, $volumeHandle);
                    break;
                case 'after':
                    $filenameParts[] = $volumeHandle;
                    break;
            }
        }
        
        // Random String
        $addRandomString = $settings->addRandomString;
        if ($addRandomString) {
            $randomString = StringHelper::randomString(8);
            switch ($addRandomString) {
                case 'before':
                    array_unshift($filenameParts, $randomString);
                    break;
                case 'after':
                    $filenameParts[] = $randomString;
                    break;
            }
        }
        
        // Create a new filename
        $delimiter = $settings->delimiter;
        $extension = $asset->getExtension();
        $newFilename = implode($delimiter, $filenameParts) . '.' . $extension;
        
        // Rename
        if ($hook === 'EVENT_BEFORE_SAVE_ELEMENT') {
            $asset->title = $filename;
            $asset->filename = $newFilename;
        }
        else {
            $folder = $asset->getFolder();
            return Craft::$app->assets->moveAsset($asset, $folder, $newFilename);;
        }
    }
}
