# Subscribe

## User subscription plugin for Craft CMS

Subscribe to mailing list software on craft user registration or activation for front end and/or cp requests.

Currently supports:

* Mailchimp

Plugin settings allow you to:

* Set API settings
* Set subscription event: User Registration / Activation
* Set request type: CP, Front End or Both
* Mailchimp specific settings: Double Opt In, Welcome Email, Update Existing Subscriptions


_NB. If you have services that you would like to add, just shout, so long as they have a decent robust API we will look to get them added._

## Installation

To install Subscribe, follow these steps:

1.  Upload the fruitsubscribe/ folder to your craft/plugins/ folder.
2.  Go to Settings > Plugins from your Craft control panel and install the Subscribe plugin.
3.  Hit Subscribe, switch on the services you need and set them up.

## Usage

What to control subscription from the front end, add a form control (checkbox, input etc) named 'subscribeConfimation' to your registration form:

```
<label for="subscribeConfimation">
	<input type="hidden" name="subscribeConfimation" value="0">
	<input type="checkbox" name="subscribeConfimation" value="1" checked="checked">
	Send me your monthly newsletter?</span>
</label>
```

Return 1 to confirm subscription and 0 to deny.

## Requirements

Craft CMS Version 2.1+

## Roadmap

* Validate API settings on save
* Imporved error / success messages for cp and front end
* Decide how to handle deleted users - should we delete subscription

## Changelog

### 0.9.1

* Added a front end override so that subscription can be overridden from within front end registration forms

### 0.9

* Initial beta release