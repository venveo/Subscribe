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

class FruitSubscribe_PluginSettingsModel extends BaseModel
{
    /**
     * @access protected
     * @return array
     */
    protected function defineAttributes()
    {
        return array(
            'mailchimpActive' => array(AttributeType::Bool, 'default' => false, 'required' => true),
            'mailchimpApiKey' => AttributeType::String,
            'mailchimpListId' => AttributeType::String,
            'mailchimpEvent' => array(AttributeType::Enum, 'required' => true, 'values' => array('users.onSaveUser', 'users.onActivateUser'), 'default' => 'users.onActivateUser'),
            'mailchimpRequest' => AttributeType::Mixed,
            'mailchimpOptions' => AttributeType::Mixed,
        );
    }

    /**
     * @param null $attributes
     * @param bool $clearErrors
     * @return bool|void
     */
    public function validate($attributes = null, $clearErrors = true)
    {
        parent::validate($attributes, $clearErrors);

        // Validate Mailchimp settings if active
        if($this->mailchimpActive)
        {
            // Validate api key
            if($this->mailchimpApiKey == '')
            {
                $this->addError('mailchimpApiKey', Craft::t('API key is required.'));
            }
            else
            {

            }

            // Validate list id
            if($this->mailchimpListId == '')
            {
                $this->addError('mailchimpListId', Craft::t('List ID is required.'));
            }
            else
            {
                
            }



        }






        return !$this->hasErrors();
    }
}
