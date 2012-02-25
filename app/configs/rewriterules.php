<?php 
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.apps.configs.rewriterules.php
 * 
 */
$aRules[] = array('name' => 'rules', 'pattern' => '/^(rules)((\.html?)?(\.xml)?(\.pdf)?)?$/i', 'open' => array('controller' => 'index', 'action' => 'rules', 'params' => NULL));
$aRules[] = array('name' => 'about_api', 'pattern' => '/^(api)((\.html?)?(\.xml)?(\.pdf)?)?$/i', 'open' => array('controller' => 'index', 'action' => 'about_api', 'params' => NULL));
$aRules[] = array('name' => 'contact', 'pattern' => '/^(contact)((\.html?)?(\.xml)?(\.pdf)?)?$/i', 'open' => array('controller' => 'index', 'action' => 'contact', 'params' => NULL));
$aRules[] = array('name' => 'index', 'pattern' => '/^(index)((\.html?)?(\.xml)?(\.pdf)?)?$/i', 'open' => array('controller' => 'index', 'action' => 'index', 'params' => NULL));
//$aRules[] = array('name' => 'api', 'pattern' => '/^(api)\/([a-z0-9]+)((\.html?)?(\.xml)?(\.pdf)?)?$/i', 'open' => array('controller' => 'index', 'action' => 'api', 'params' => array('/[a-z0-9]+/i')));

//$aRules[] = array('name' => 'act_change_email', 'pattern' => '/^(account)\/(accept)\/(email)\/([a-z0-9]+)\/([a-z0-9]{20})((\.html?)?(\.xml)?(\.pdf)?)?$/i', 'open' => array('controller' => 'account', 'action' => 'act_change_email', 'params' => array('/[a-z0-9]+/i', '/[a-z0-9]{20}/i')));
