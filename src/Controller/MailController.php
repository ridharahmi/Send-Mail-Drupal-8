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
        $result  = $query->execute();
        $submission_data = [];
        foreach ($result as $item) {
            $submission = \Drupal\webform\Entity\WebformSubmission::load($item);
            $submission_data[] = $submission->getData();
        }
        //kint($submission_data);


        $mailManager = \Drupal::service('plugin.manager.mail');
        $langcode = \Drupal::currentUser()->getPreferredLangcode();
        $params['context']['subject'] = 'test Subject';
        $params['context']['message'] = 'test body';
        $to = 'developpementweb77@gmail.com';
        $m = $result['result'] = $mailManager->mail('system', 'mail', $to, $langcode, $params);
       //kint($result['result']);

            return [
                '#type' => 'markup',
                '#markup' => $this->t('test Send Newsletter'),
            ];



    }

}

