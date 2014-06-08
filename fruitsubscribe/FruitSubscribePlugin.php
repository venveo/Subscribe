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

class FruitSubscribePlugin extends BasePlugin
{
    /**
     * Get Name
     */	
    function getName()
	{
		return 'Subscribe';
	}

    /**
     * Get Version
     */
    function getVersion()
	{
		return '0.9';
	}

    /**
     * Get Developer
     */
	function getDeveloper()
	{
		return 'Fruit Studios';
	}

    /**
     * Get Developer URL
     */
	function getDeveloperUrl()
	{
		return 'http://fruitstudios.co.uk';
	}

	protected function getSettingsModel()
	{
	    return new FruitSubscribe_PluginSettingsModel();
	}


	public function getSettingsHtml()
	{
		craft()->templates->includeCssResource('fruitsubscribe/css/settings.css');
		craft()->templates->includeJsResource('fruitsubscribe/js/settings.js');
		
		return craft()->templates->render('fruitsubscribe/settings', array(
			'settings' => $this->getSettings(),
			'mailchimpSettingsId' => craft()->templates->namespaceInputId('mailchimpSubscribeSettings')
		));
	}


	public function init() 
	{

		Craft::log(__METHOD__, LogLevel::Info, true);

		$settings = $this->getSettings();

		if($settings['mailchimpActive'] && $settings['mailchimpApiKey'] && $settings['mailchimpListId'])
		{
			craft()->on($settings['mailchimpEvent'], function(Event $event) 
			{
				
				$settings = craft()->plugins->getPlugin('fruitsubscribe')->getSettings();
				
				// Check request, for cp, fe or both
				$subscribeRequestCp = craft()->request->isCpRequest() && ( $settings['mailchimpRequest'] == '*' || $settings['mailchimpRequest'] == 'cp' ) ? true : null;
				$subscribeRequestFe = !craft()->request->isCpRequest() && ( $settings['mailchimpRequest'] == '*' || $settings['mailchimpRequest'] == 'fe' ) ? true : null;

				if( $subscribeRequestCp || $subscribeRequestFe )
				{

					switch($settings['mailchimpEvent'])
					{
						case('users.onSaveUser'):
							$user = $event->params['isNewUser'] && $event->params['user'] ? $event->params['user'] : null;
							break;

						case('users.onActivateUser'):
							$user = $event->params['user'] ? $event->params['user'] : null;
							break;

						default:
							$user = null;
							break;
					}

					if($user)
					{

						$result = craft()->fruitSubscribe->mailchimpSubscribeUser($user);

						if($result['subscribed'])
						{
							craft()->userSession->setNotice($result['notice']);
							Craft::log(__METHOD__.' : '.$user->fullName.' - '.$result['notice'], LogLevel::Info, true);
						}
						else
						{
							craft()->userSession->setError($result['notice']);
							Craft::log(__METHOD__.' : '.$user->fullName.' - '.$result['error'], LogLevel::Error, true);
						}

					}

				}
				else
				{
					Craft::log(__METHOD__.' : Mailchimp subscribe not active for this request or missing your api key or list ID', LogLevel::Info, true);
				}
			
			});
		}
		
	}

}
