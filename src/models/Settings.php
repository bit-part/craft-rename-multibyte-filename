<?php
/**
 * Rename Multibyte Filename plugin for Craft CMS 3.x
 *
 * Rename a multibyte character filename, such as Japanese, Chinese, Korean, and so on, when assets are uploaded.
 *
 * @link      https://bit-part.net
 * @copyright Copyright (c) 2020 bit part LLC
 */

namespace bitpart\renamemultibytefilename\models;

use bitpart\renamemultibytefilename\RenameMultibyteFilename;

use Craft;
use craft\base\Model;

/**
 * RenameMultibyteFilename Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    bit part LLC
 * @package   RenameMultibyteFilename
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some field model attribute
     *
     * @var string
     */
    public $addVolumeHandle = '';
    public $addRandomString = '';
    public $filenameFormat = 'time';
    public $delimiter = '-';

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['addRandomString', 'string'],
            ['filenameFormat', 'string'],
        ];
    }
}
