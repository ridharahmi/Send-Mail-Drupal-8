<?php


namespace Drupal\send_mail\Controller;

use Drupal\Core\Controller\ControllerBase;


class MailController extends ControllerBase
{


    /**
     * {@inheritdoc}
     */
    public function content()
    {

        $query = \Drupal::entityQuery('webform_submission')
            ->condition('webform_id', 'subscribe');
        $result = $query->execute();
        $submission_data = [];
        foreach ($result as $item) {
            $submission = \Drupal\webform\Entity\WebformSubmission::load($item);
            $submission_data[] = $submission->getData();
        }
        //kint($submission_data);


        $mailManager = \Drupal::service('plugin.manager.mail');
        $sitename = \Drupal::config('system.site')->get('name');
        $langcode = \Drupal::currentUser()->getPreferredLangcode();
        $params['context']['subject'] = 'test Subject';
        $params['context']['message'] = t('Your wonderful message about @sitename', array('@sitename' => $sitename));
        $to = 'ridha.rahmi@hotmail.com';
        $result['result'] = $mailManager->mail('system', 'mail', $to, $langcode, $params);
        //kint($result['result']);

//        $lang = \Drupal::languageManager()->getCurrentLanguage()->getId();
//        $sitename = \Drupal::config('system.site')->get('name');
//        $langcode = \Drupal::config('system.site')->get('langcode');
//
//
//        $to = 'ridha.rahmi@hotmail.com';
//        $reply = NULL;
//        $send = TRUE;
//
//        $params['message'] = t('Your wonderful message about @sitename', array('@sitename' => $sitename));
//        $params['subject'] = t('Message subject');
//        $params['options']['username'] = 'ridha rahmi';
//        $params['options']['title'] = t('Your wonderful title');
//        $params['options']['footer'] = t('Your wonderful footer');
//
//        $mailManager = \Drupal::service('plugin.manager.mail');
//        $mailManager->mail('system', $to, $langcode, $params, $reply, $send);


        return [
            '#type' => 'markup',
            '#markup' => $this->t('Your mail has been sent successfuly ! Thank you for your feedback!'),
        ];


    }

}

