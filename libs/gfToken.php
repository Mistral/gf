<?php

if (!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}

/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.gfToken
 * 
 */
class gfToken {

    public function isValid($sToken) {
        if (gf::Session()->getSession('token') == $sToken) {
            return true;
        } else {
            return false;
        }
    }

}