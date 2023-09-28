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
    protected array|int|bool $allowAnonymous = true;

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
            'email' => Craft::$app->request->getParam('email'),
            'product_name' => Craft::$app->request->getParam('product_name'),
            'download_file' => Craft::$app->request->getParam('redirect'),
        ]);
        EmailList::$plugin->email->saveEmail($model);
        return $this->redirect(Craft::$app->request->getValidatedBodyParam('redirect'));
    }

    public function actionExport()
    {
        $this->requireCpRequest();
        $data['emails'] = EmailList::$plugin->email->getEmails();

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=emails.csv');
        header("Content-Transfer-Encoding: UTF-8");

        $f = fopen('php://output', 'a');

        foreach ($data['emails'] as $email) {
            fputcsv($f, [$email->email]);
        }

        fclose($f);
        die();
    }
}
