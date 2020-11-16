<?php

/*
 * LimeSurvey Authentication simple plugin before survey for Limesurvey 3.14+
 * Author: Paolo Moresco
 * License: GNU General Public License v3.0
 * 
 * This plugin is based on the following LimeSurvey Plugins:
 * URL: https://github.com/Frankniesten/Limesurvey-SAML-Authentication
 * URL: https://github.com/LimeSurvey/LimeSurvey/blob/master/application/core/plugins/Authwebserver/Authwebserver.php
 * URL: https://github.com/LimeSurvey/LimeSurvey/blob/master/application/core/plugins/AuthLDAP/AuthLDAP.php
 * URL: https://github.com/pitbulk/limesurvey-saml
 * 
 */

class AuthSAMLBeforeSurvey extends PluginBase {

    protected $storage = 'DbStorage';
    static protected $name = 'SAML Before Survey';
    static protected $description = 'Core: SAML authentication before Survey Page';
    
    protected $settings = array(
        'simplesamlphppath' => array(
            'type' => 'string',
            'label' => 'Path to the SimpleSAMLphp folder',
            'default' => '/usr/share/simplesamlphp',
        ),
        'samlauthsource' => array(
            'type' => 'string',
            'label' => 'SAML authentication source',
            'default' => 'default-sp',
        ),
        'samlmailmapping' => array(
            'type' => 'string',
            'label' => 'SAML attributed used as email',
            'default' => 'mail',
        ),
    );
    
    public function init()
    {
        $this->subscribe('beforeSurveyPage');
    }


    /**
    * Require authentication before display survey page
    */

    public function beforeSurveyPage()
    {

	    $ssp = $this->get_saml_instance();
        
        $ssp->requireAuth();

        $this->log($this->getUserMail());

    }

     /**
     * Initialize SAML authentication
     * @return void
     */
    protected function get_saml_instance() {
        
        if ($this->ssp == null) {
            
            $simplesamlphp_path = $this->get('simplesamlphppath', null, null, '/var/www/simplesamlphp');
            
            require_once($simplesamlphp_path.'/lib/_autoload.php');
            
            $saml_authsource = $this->get('samlauthsource', null, null, 'limesurvey');
            
            $this->ssp = new \SimpleSAML\Auth\Simple($saml_authsource);
	    }
        
        return $this->ssp;
    }
    
     /**
     * Get Userdata from SAML Attributes
     * @return void
     */

    public function getUserMail() {
        
        $mail = '';
        $ssp = $this->get_saml_instance();
        $attributes = $this->ssp->getAttributes();
        if (!empty($attributes)) {
            $saml_mail_mapping = $this->get('saml_mail_mapping', null, null, 'mail');
            if (array_key_exists($saml_mail_mapping , $attributes) && !empty($attributes[$saml_mail_mapping])) {
                $mail = $attributes[$saml_mail_mapping][0];
            }
        }
        
        return $mail;
    }
}
