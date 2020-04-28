<?php
/**
 * Olivemenus plugin for Craft CMS 3.x
 *
 * OliveStudio menu
 *
 * @link      http://www.olivestudio.net/
 * @copyright Copyright (c) 2018 Olivestudio
 */

namespace lukehopkins\emaillist\controllers;

use Craft;
use craft\web\Controller;
use lukehopkins\emaillist\EmailList;
use lukehopkins\emaillist\models\Email as EmailModel;

class ListController extends Controller
{
    protected $allowAnonymous = true;

    public function actionIndex()
    {
        $this->requireCpRequest();
        $data['emails'] = EmailList::$plugin->email->getEmails();
        return $this->renderTemplate('email-list/list', $data);
    }

    public function actionSave()
    {
        $model = new EmailModel();
        $model->setAttributes([
            'email' => Craft::$app->request->getQueryParam('email'),
            'product_name' => Craft::$app->request->getQueryParam('product_name'),
            'download_file' => Craft::$app->request->getQueryParam('redirect'),
        ]);
        EmailList::$plugin->email->saveEmail($model);
        return $this->redirect(Craft::$app->request->getQueryParam('redirect'));
    }
}
