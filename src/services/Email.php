<?php
/**
 * Email List plugin for Craft CMS 3.x
 *
 * A plugin for saving emails to a list
 *
 * @link      https://github.com/luke-hopkins
 * @copyright Copyright (c) 2020 Luke Hopkins
 */

namespace lukehopkins\emaillist\services;

use lukehopkins\emaillist\EmailList;

use Craft;
use craft\base\Component;
use lukehopkins\emaillist\records\Email as EmailRecord;

/**
 * Email Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Luke Hopkins
 * @package   EmailList
 * @since     1.0.0
 */
class Email extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     EmailList::$plugin->email->exampleService()
     *
     * @return mixed
     */


    public function getEmails()
    {
        return EmailRecord::find()->all();
    }

    public function saveEmail($model)
    {
        $record = new EmailRecord();
        $record->email = $model->email;
        $record->product_name = $model->product_name;
        $record->download_file = $model->download_file;
        $save = $record->save();
        return $save;
    }
}
