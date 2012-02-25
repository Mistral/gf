<?php

if (!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}

/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.libraries.gfMail
 * @example gfFW.docs.USE.Mail
 * 
 */
class gfMail {

    protected $__aData = array();

    public function index($sTopic) {
        $this->__aData['settings']['topic'] = $sTopic;
        $this->__aData['settings']['email'] = gfConfigFW::getConfig('email');
        $this->__aData['settings']['site'] = gfConfigFW::getConfig('site_name');
        $this->__aData['settings']['domain'] = gfConfigFW::getConfig('site_domain');
        $this->__aData['settings']['footer'] = gfConfigFW::getConfig('email_footer');
        $this->__aData['from'] = 'From: ' . $sTopic . ' - ' . $this->__aData['settings']['site'] . ' <' . $this->__aData['settings']['email'] . '>';
        $this->__aData['mime'] = 'MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\n';
        $this->__aData['archiwum'] = '\r\nCc: archiwum@' . $this->__aData['settings']['domain'] . '\r\nBcc: kontrola@' . $this->__aData['settings']['domain'] . '\r\n';
        $this->__aData['header'] = $this->__aData['mime'] . $this->__aData['from'] . $this->__aData['archiwum'];
    }

    public function sendOneMail($sEmail, $sMsg) {
        $this->_createSectionTo($sEmail, $sEmail);
        $this->__aData['content'] = $sMsg . '<br />' . $this->__aData['settings']['footer'];
        @mail($this->__aData['to'], $this->__aData['settings']['topic'], $this->__aData['content'], $this->__aData['header']);
    }

    private function _createSectionTo($sName, $sEmail) {
        $this->__aData['to'] = $sName . '<' . $sEmail . '>';
    }

    private function _createMassSectionTo($aClients) {
        $this->__aData['to'] = $aClients;
    }

    public function sendMassMail($aClients, $sMsg) {
        $this->_createMassSectionTo($aClients);
        $this->__aData['content'] = $sMsg . '<br />' . $this->__aData['settings']['footer'];
        foreach ($this->__aData['to'] as $v) {
            $to_section = '';
            $to_section = $v['name'] . '<' . $v['email'] . '>';
            @mail($to_section, $this->__aData['settings']['topic'], $this->__aData['content'], $this->__aData['header']);
        }
    }

}

?>