<?php

/**
* Fruit Subscribe Plugin by Fruit Studios
 *
 * @package   Craft Subscribe
 * @author    Sam Hibberd
 * @copyright Copyright (c) 2014, Fruit Studios
 * @link      http://fruitstudios.co.uk
 * @license   http://fruitstudios.co.uk
 */

namespace Craft;

class FruitSubscribeService extends BaseApplicationComponent
{
    public function mailchimpSubscribeUser($user)
    {        
        $settings = craft()->plugins->getPlugin('fruitsubscribe')->getSettings();

        require_once(CRAFT_PLUGINS_PATH.'fruitsubscribe/resources/vendors/mailchimp/MailChimp.php');
        
        $MailChimp = new \Drewm\MailChimp($settings['mailchimpApiKey']);

        $apiResult = $MailChimp->call('lists/subscribe', array(
            'id'                => $settings['mailchimpListId'],
            'email'             => array('email'=>$user->email),
            'merge_vars'        => array('FNAME'=>$user->firstName, 'LNAME'=>$user->lastName),
            'double_optin'      => in_array('double_optin', (array)$settings['mailchimpOptions']),
            'update_existing'   => in_array('update_existing', (array)$settings['mailchimpOptions']),
            'replace_interests' => in_array('replace_interests', (array)$settings['mailchimpOptions']),
            'send_welcome'      => in_array('send_welcome', (array)$settings['mailchimpOptions']),
        ));

        $result = array();
        $result['subscribed'] = false;
        $result['notice'] = '';
        $result['error'] = '';

        if( isset($apiResult['email']) )
        {
            $result['subscribed'] = true;
            $result['notice'] = 'User Subscribed To Mailchimp';
        }
        else
        {
            switch($apiResult['code'])
            {                  
                case(214):
                    $result['notice'] = 'Users email already subscribed to Mailchimp';
                    $result['error'] = 'Email already subscribed to Mailchimp';
                    break;                  
                default:
                    $result['notice'] = 'Mailchimp Error '.$apiResult['code'].' ('.$apiResult['name'].')';
                    $result['error'] = 'Mailchimp Error '.$apiResult['code'].' ('.$apiResult['name'].' - '.$apiResult['error'].')';
                    break;
            }

        }
        
        return $result;
    }

}


