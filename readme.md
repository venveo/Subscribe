# Subscribe plugin for Craft

Subscribe to mailing list software on craft user registration activation for front end and / or cp requests.

Currently supports:

* Mailchimp

NB. If you have serveices that you would like to add just shout, so long as they have a decent robust API we will look to get them added.


Plugin settings allow you to:

* Set API settings
* Set subscription event: User Registration / Activation
* Set request type: CP, Front End or Both
* Mailchimp specific settings: Double Opt In, Welcome Email, Update Existing Subscriptions


## Installation

To install Subscribe, follow these steps:

1.  Upload the fruitsubscribe/ folder to your craft/plugins/ folder.
2.  Go to Settings > Plugins from your Craft control panel and install the Subscribe plugin.
3.  Hit Subscribe, switch it on and set it up.


## Roadmap

* Add a front end override so that subscription can be overridden from within front end registration forms
* Validate API settings on save
* Imporved error / success messages for cp and front end
* Decide to handle deleted users - should we delete subscription

## Changelog

### 0.9

* Initial beta release
