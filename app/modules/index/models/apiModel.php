<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mistral
 * Date: 23.05.11
 * Time: 20:16
 * To change this template use File | Settings | File Templates.
 */
 
class apiModel extends gfModel {

    public function genLink() {
       $string = "abcdefghijklmnoprstuwxyzABCDEFGHIJKLMNOPRSTUWXYZ1234567890"; // można dodać jeszcze duże litery - DONE
        $dlugosc_stringa = strlen($string);
        $dlugosc = 6;

        $losowy_ciag = '';
        for($i = 1; $i <= $dlugosc; $i++) {
            $losowy_ciag .= substr($string, mt_rand(0, $dlugosc_stringa-1), 1);
        }

        return $losowy_ciag;
    }

    public function issetDb($sSkrot) {
        $oStmt = gfFW::MySQL()->prepare('SELECT * FROM `'.gfFW::MySQL()->getPrefix().'links` WHERE `skrot` = :1');
	   	$oStmt -> addParam(':1', $sSkrot, gfMySQL_PARAM_STR);
	   	$aFetch = $oStmt -> execute() -> fetchArray();
        if(isset($aFetch['id'])) {
            return true;
        }
        return false;
    }

    public function issetLinkDb($sLink) {
		$oStmt = gfFW::MySQL()->prepare('SELECT * FROM `'.gfFW::MySQL()->getPrefix().'links` WHERE `link` = :1');
	   	$oStmt -> addParam(':1', $sLink, gfMySQL_PARAM_STR);
	   	$aFetch = $oStmt -> execute() -> fetchArray();
        if(isset($aFetch['id'])) {
            return true;
        }
        return false;
    }

    public function add($link, $skrot) {
        $oStmt = gfFW::MySQL()->prepare('INSERT INTO `'.gfFW::MySQL()->getPrefix().'links` (link, skrot) VALUES (:1, :2)');
        $oStmt -> addParam(':1', $link, gfMySQL_PARAM_STR);
        $oStmt -> addParam(':2', $skrot, gfMySQL_PARAM_STR);
        $oStmt -> execute();
    }

     public function getShort($sLink) {
		$oStmt = gfFW::MySQL()->prepare('SELECT `skrot` FROM `'.gfFW::MySQL()->getPrefix().'links` WHERE `link` = :1');
	   	$oStmt -> addParam(':1', $sLink, gfMySQL_PARAM_STR);
	   	$aFetch = $oStmt -> execute() -> fetchArray();
        if(isset($aFetch['skrot'])) {
            return $aFetch['skrot'];
        }
        return false;
    }


}