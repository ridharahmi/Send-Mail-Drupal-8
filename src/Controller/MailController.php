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
        $mailManager = \Drupal::service('plugin.manager.mail');
        $sitename = \Drupal::config('system.site')->get('name');
        $langcode = \Drupal::config('system.site')->get('langcode');
        $module = 'send_mail';
        $key = 'my_key';
        $reply = NULL;
        $send = TRUE;
        $to = 'ridha.rahmi@hotmail.com';
        //$to = 'developpementweb77@gmail.com';
        $params['message'] = t('Your wonderful message about @sitename', array('@sitename' => $sitename));
        $params['subject'] = t('Message subject');
        $params['options']['username'] = 'ridha rahmi';
        $params['options']['title'] = 'Your wonderful title';
        $params['options']['footer'] = 'Your wonderful footer';
        $result['result'] = $mailManager->mail('system', $to, $langcode, $params);
        //kint($result['result']);

        return [
            '#type' => 'markup',
            '#markup' => $this->t('Your mail has been sent successfuly ! Thank you for your feedback!'),
        ];
    }

}

