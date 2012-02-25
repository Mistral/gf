<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.core.access.simple.gfAccess
 * 
 */

class gfAccess_simple {
    
    /**
     * Tablica przechowujaca dane uzytkownika
     * Tablica zawierajace informacje o ogolnym access'ie [access], pelnym spisie praw dostepu [full_access] oraz przynalezenia do grupy [group]
     *
     * @var array
     */
    private $_aUser = array('access' => 1, 'full_access' => array(00000, 00001), 'group' => 1);
    
    /**
     * Tablica przechowujaca dostepne access'y
     * Tablica przechowuje ID dostepnych access'ow, dane pobrane sa z tabeli `access`
     *
     * @var array
     */
    private $_aAvailableAccess = array();
    
    /**
     * Zmienna przechowujaca uzytego access'a
     * Zmienna przechowuje uzytego aktualnie access'a aby nadac uprawnienia sesyjne.
     *
     * @var int
     */
    private $_iUsedAccess = 00000;
    
    /**
     * Przechowuje obiekt sesji
     *
     * @var resource
     */
    private $_oSession;

    /**
     * Konstruktor klasy gfAccess_simple
     * Tworzy nowa instancje obiektu gfSession i zapisuje je do zmiennej {@link gfAccess_simple::$_oSession}.
     * Wykonuje zapytanie do bazy danych, aby pobrac aktualne accessy i ich numery - zapytanie jest cachowane na 10 dni
     * Zapisuje accessy do tablicy {@link gfAccess_simple::$_aAvailableAccess}
     * Wykonuje zapytanie do bazy danych o access, full_access i grupe danego uzytkownika, sprawdzajac jego ID poprzez {@link gfSession::getName()}
     * Zapisuje dane pobrazne z DB do tablicy {@link gfAccess_simple::$_aUser}
     *
     */
    public function __construct() {
        $this -> _oSession = gfFW::Session();
        $stmt = gfFW::MySQL()->prepare('SELECT `access`, `full_access`, `group` FROM `'.gfFW::MySQL()->getPrefix().'users` WHERE `id` = :1');
        $stmt -> addParam(':1', ($this -> _oSession -> getName() != 'guest') ? $this -> _oSession -> getUserID() : 1, gfMySQL_PARAM_INT);
        $stmts = $stmt -> execute();
        $row = $stmts -> fetch_array_all();
		$aFetch = (array) $row[0];
        $this -> _aUser = array('access' => $aFetch['access'], 'full_access' => unserialize($aFetch['full_access']), 'group' => $aFetch['group']);
    }

    /**
     * Pobiera full_access z DB
     * Wykonuje zapytanie do bazy danych pobierajace full_access od danego uzytkownika
     * Odserializowuje dane pobrane z DB i zwraca je.
     *
     * @param int $iID Numer ID uzytkownika z bazy danych tabeli `USERS`
     * @return array Tablica wszystkich accessow danego uzytkownika
     */
    public function getAccess($iID) {
        $stmt = gfFW::MySQL()->prepare('SELECT `full_access` FROM `'.gfFW::MySQL()->getPrefix().'users` WHERE `id` = :1');
        $stmt -> addParam(':1', $iID, gfMySQL_PARAM_INT);
        $aFetch = $stmt -> execute() -> fetch_array();
        return unserialize($aFetch['full_access']);
    }

    /**
     * Zapisuje kilka accessow do bazy danych
     * czy tablice 1. Zwrot funkcji {@link gfAccess_simple::getAccess($iID)} 2. tablica przekazana do funkcji jako parametr $aAccess
     * Polaczona tablice przekazuje do funkcji {@link gfAccess_simple::setFullAccess($aArrayAccess, $iID}
     *
     * @param array $aAccess Tablica wypelniona numerami uprawnien [accessow]
     * @param int $iID Numer ID uzytkownika z tabeli `users`
     */
    public function setCustomAccess($aAccess, $iID) {
        $aArrayAccess = array_merge($this -> getAccess($iID), $aAccess);
        $this -> setFullAccess($aArrayAccess, $iID);
    }

    /**
     * @param unknown_type $iAccess
     * @param unknown_type $iID
     */
    public function setOneAccess($iAccess, $iID) {
        $aArrayAccess = array_merge($this -> getAccess($iID), array($iAccess));
        $this -> setFullAccess($aArrayAccess, $iID);
    }

    public function setFullAccess($aAccess, $iID) {
        $stmt = gfFW::MySQL()->prepare('UPDATE `'.gfFW::MySQL()->getPrefix().'users` SET `full_access` = :a WHERE `id` = :s');
        $stmt -> addParam(':a', serialize($aAccess), gfMySQL_PARAM_STR);
        $stmt -> addParam(':s', $iID, gfMySQL_PARAM_INT);
        $stmt -> execute();
    }
    
    public function isAuthUser($iAccess, $iUserID) {
        $stmt = gfFW::MySQL()->prepare('SELECT `full_access` FROM `'.gfFW::MySQL()->getPrefix().'users` WHERE `id` = :1');
        $stmt -> addParam(':1', $iUserID, gfMySQL_PARAM_INT);
        $aFetch = $stmt -> execute() -> fetch_array();
        $aArrayAccess = unserialize($aFetch['full_access']);
        foreach ($aArrayAccess as $v) {
            if($v == $iAccess) {
                return true;
            }
        }
        return false;
    }

    public function isAuth($iAccess) {
        foreach ($this -> _aUser['full_access'] as $v) {
            if($v == $iAccess) {
                return true;
            }
        }
        return false;
    }
}
