<?php

if (!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}

/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.gfValidate
 * 
 */
class gfValidate {
    const EMAIL = '/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i';
    const NAME = '/^([a-z0-9]{1})([a-z0-9_-]{2,11})$/Diu';
    const URL = '/^(http|ftp)([s]{0,1}):\/\/([a-z0-9]{1})((([a-z0-9-]*[-]{2})|([a-z0-9])*|([a-z0-9-]*[-]{1}[a-z0-9]+))*)((\.[a-z0-9](([a-z0-9-]*[-]{2})|([a-z0-9]*)|([a-z0-9-]*[-]{1}[a-z0-9]+))+)*)(\.([a-z0-9]{2,6})){0,1}((:[0-9]){0}|(:[1-9]{1}[0-9]*))\//iu';
    const IPv4 = '/^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/Du';
    const IPv6 = '/^((([0-9A-Fa-f]{1,4}:){7}(([0-9A-Fa-f]{1,4})|:))|(([0-9A-Fa-f]{1,4}:){6}(:|((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})|(:[0-9A-Fa-f]{1,4})))|(([0-9A-Fa-f]{1,4}:){5}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(([0-9A-Fa-f]{1,4}:){4}(:[0-9A-Fa-f]{1,4}){0,1}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(([0-9A-Fa-f]{1,4}:){3}(:[0-9A-Fa-f]{1,4}){0,2}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(([0-9A-Fa-f]{1,4}:){2}(:[0-9A-Fa-f]{1,4}){0,3}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(([0-9A-Fa-f]{1,4}:)(:[0-9A-Fa-f]{1,4}){0,4}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(:(:[0-9A-Fa-f]{1,4}){0,5}((:((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})?)|((:[0-9A-Fa-f]{1,4}){1,2})))|(((25[0-5]|2[0-4]\d|[01]?\d{1,2})(\.(25[0-5]|2[0-4]\d|[01]?\d{1,2})){3})))(%.+)?$/Du';
    const POST_CODE = '/^[0-9]{2}-?[0-9]{3}$/Du';

    public function valid($sString, $cRegex) {
        $sPreparedString = trim($sString);
        if (preg_match($cRegex, $sPreparedString)) {
            return true;
        } else {
            return false;
        }
    }

    public function matchEqual($sString, $sString2) {
        if (strcasecmp($sString, $sString2) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function match($sString, $sString2) {
        if (strcmp($sString, $sString2) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isEqualInt($iInt, $iInt2) {
        if ((int) $iInt === (int) $iInt2) {
            return true;
        } else {
            return false;
        }
    }

    public function isInt($iInt) {
        if (is_numeric($iInt)) {
            return true;
        } else {
            return false;
        }
    }

    public function isFloat($iFloat) {
        if (is_float($iFloat)) {
            return true;
        } else {
            return false;
        }
    }

    public function isDobule($iDouble) {
        if (is_double($iDouble)) {
            return true;
        } else {
            return false;
        }
    }

    public function isString($sString) {
        if (is_string($sString)) {
            return true;
        } else {
            return false;
        }
    }

    public function getLength($sString) {
        return strlen(trim($sString));
    }

}
