# Limesurvey-SAML-Authentication-BeforeSurvey
Limesurvey Authentication simple plugin for SAML authentication before display survey page

## Requirements
- LimeSurvey 3.14+
- simpleSAMLphp

## Installation simpleSAMLphp
- Download simpleSAMlphp: https://simplesamlphp.org/download
- Install simpleSAMlphp as Service Providor: https://simplesamlphp.org/docs/stable/simplesamlphp-sp

## Installation LimeSurvey
- Download Limesurvey: https://www.limesurvey.org/stable-release
- Install the application according to this manual:https://manual.limesurvey.org/Installation_-_LimeSurvey_CE
- Download the SAML Auhthentication Before Survey plugin.
- Unzip the file and upload the plugin in the Limesurvey Plugin Manager.
- Configure the plugin.
- Activate the plugin.


### This plugin is based on the following LimeSurvey Plugins:
 - https://github.com/Frankniesten/Limesurvey-SAML-Authentication
 - https://github.com/LimeSurvey/LimeSurvey/blob/master/application/core/plugins/Authwebserver/Authwebserver.php
 - https://github.com/LimeSurvey/LimeSurvey/blob/master/application/core/plugins/AuthLDAP/AuthLDAP.php
 - https://github.com/pitbulk/limesurvey-saml
