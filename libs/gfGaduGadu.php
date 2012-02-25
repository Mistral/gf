<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.libraries.gfGaduGadu
 * @example gfFW.docs.USE.GaduGadu
 */

/*
* phplibgadu 0.2
* Oparte na http://dev.null.pl/ekg/docs/protocol.html
* Autor: ďż˝ukasz Lach, 2004 <mail@php5.pl>
*/

gfRunner::setConstans('GG_WELCOME',                  0x0001, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_LOGIN',                    0x000C, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_LOGIN_OK',                 0x0003, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_LOGIN_FAILED',             0x0009, array('infile' => __FILE__, 'inline' => __LINE__));

gfRunner::setConstans('GG_NEW_STATUS',               0x0002, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_STATUS_NOT_AVAIL',         0x0001, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_STATUS_NOT_AVIAL_DESCR',   0x0015, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_STATUS_AVAILABLE',         0x0002, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_STATUS_AVAILABLE_DESCR',   0x0004, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_STATUS_BUSY',              0x0003, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_STATUS_BUSY_DESCR',        0x0005, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_STATUS_INVISIBLE',         0x0014, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_STATUS_INVISIBLE_DESCR',   0x0016, array('infile' => __FILE__, 'inline' => __LINE__));

gfRunner::setConstans('GG_NOTIFY',                   0x0010, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_NOTIFY_REPLY',             0x000C, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_NOTIFY_REPLY60',           0x0011, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_PUBDIR50_REQUEST',         0x0014, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_PUBDIR50_REPLY',           0x000e, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_SEND_MSG',                 0x000B, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_CLASS_MSG',                0x0004, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_CLASS_CHAT',               0x0008, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_SEND_MSG_ACK',             0x0005, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_ACK_DELIVERED',            0x0002, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_ACK_QUEUED',               0x0003, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_RECV_MSG',                 0x000A, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_ACK_MBOXFULL',             0x0004, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_PING',                     0x0008, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_PING_TIMEOUT',             180, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_PONG',                     0x0007, array('infile' => __FILE__, 'inline' => __LINE__));

gfRunner::setConstans('GG_FONT_BOLD',                0x01, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_FONT_ITALIC',              0x02, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_FONT_UNDERLINE',           0x04, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_FONT_COLOR',               0x08, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('GG_FONT_IMAGE',               0x80, array('infile' => __FILE__, 'inline' => __LINE__));

gfRunner::setConstans('GG_CONN_TIMEOUT',             5, array('infile' => __FILE__, 'inline' => __LINE__));

$ggServer = array('217.17.41.88', '217.17.41.83', '217.17.41.84', '217.17.41.85');

class gfGaduGadu {

    private $hSocket;

    public function __construct() {
    }

    // }}}
    // {{{ connect()
    /**
          * Metoda nawiďż˝zujďż˝ca poďż˝ďż˝czenie z serwerem Gadu-Gadu
          *
          * @param integer $uid numer Gadu-Gadu klienta
          * @param string $password hasďż˝o uďż˝ywane do poďż˝ďż˝czenia z serwerem Gadu-Gadu
          * @param integer[optional] $status status uďż˝ytkownika, ustawiany po poďż˝ďż˝czeniu
          *
          * @access public
          * @return boolean
        */
    public function connect($uid, $password, $status = GG_STATUS_INVISIBLE) {
        global $ggServer;

        if (false === ($aServer = $this->_findServer($uid))) {
            $host = $ggServer[array_rand($ggServer)];
            $port = 8074;
        } else {
            $host = $aServer[0];
            $port = $aServer[1];
        }
        $this->hSocket = fsockopen($host, $port, &$errorNumber, &$errorString, GG_CONN_TIMEOUT);
        if ($this->hSocket) {
            if (!$data = fread($this->hSocket, 12)) return false;
            $aData = unpack('Vtype/Vsize/Vkey', $data);
            fwrite($this->hSocket, pack('VVVVVVVv', GG_LOGIN, 0x16, $uid, $this->_loginHash($password, (int)$aData['key']),
            $status, 0x1C, 0, 0));
            stream_set_blocking($this->hSocket, 0);
            return true;
        }
        return false;
    }

    // }}}
    // {{{ changeStatus()
    /**
          * Zmiana statusu uďż˝ytkownika
          *
          * @param integer $status status uďż˝ytkownika, ustawiany po poďż˝ďż˝czeniu
          * @param string[optional] $statusDescription opis statusu
          *
          * @access public
          * @return void
        */
    public function changeStatus($status, $statusDescription = null) {

        if ($statusDescription !== null) {
            switch ($status) {
                case GG_STATUS_AVAILABLE: $status = GG_STATUS_AVAILABLE_DESCR; break;
                case GG_STATUS_BUSY: $status = GG_STATUS_BUSY_DESCR; break;
                case GG_STATUS_INVISIBLE: $status = GG_STATUS_INVISIBLE_DESCR;
            }
            fwrite($this->hSocket, pack('VVVa'.strlen($statusDescription), GG_NEW_STATUS, 0x04+strlen($statusDescription),
            $status, $statusDescription));
        } else
        fwrite($this->hSocket, pack('VVV', GG_NEW_STATUS, 0x04, $status));
    }

    // }}}
    // {{{ seekPublicDirectory()
    /**
          * Pobranie danych dowolnego uďż˝ytkownika z katalogu publicznego
          *
          * @param integer $uin numer Gadu-Gadu uďż˝ytkownika
          *
          * @access public
          * @return void
        */
    public function seekPublicDirectory($uin) {

        fwrite($this->hSocket, pack('VVCVa8Ca'.strlen($uin).'Ca10Ca1C', GG_PUBDIR50_REQUEST, 28+strlen($uin), 0x03, 0, 'FmNumber', 0, $uin,
        0, 'ActiveOnly', 0, '0', 0));
    }

    // }}}
    // {{{ sendMessage()
    /**
          * Metoda wysylajaca wiadomosc
          *
          * @param integer $recipient numer Gadu-Gadu odbiorcy
          * @param string $message wiadomo?ďż˝ do wysďż˝ania
          * @param boolean[optional] $html wiadomo?ďż˝ zawiera znaczniki HTML
          *
          * @access public
          * @return integer numer identyfikacyjny sesji
        */
    public function sendMessage($recipient, $message, $html = false) {

        $mSeq = rand(0, 9999);
        $message = strip_tags($message, '<i><b><u><font><br>');
        $message = strtr($message, "\xA1\xA6\xAC\xB1\xB6\xBC", "\xA5\x8C\x8F\xB9\x9C\x9F");
        if ($html && $fontFormat = $this->_fontFormat($message)) {
            $message = strip_tags($message);
            $msgPacket = pack('VVVVVa'.strlen($message).'CCv', GG_SEND_MSG, 0x10+strlen($message)+strlen($fontFormat),
            $recipient, $mSeq, GG_CLASS_MSG, $message, 0, 0x02, strlen($fontFormat)).$fontFormat;
        } else $msgPacket = pack('VVVVVa'.strlen($message).'C', GG_SEND_MSG, 0x0D+strlen($message),
        $recipient, $mSeq, GG_CLASS_MSG, $message, 0);
        fwrite($this->hSocket, $msgPacket);
        return $mSeq;
    }

    // }}}
    // {{{ disconnect()
    /**
          * Metoda wylogowujaca uďż˝ytkownika i zamykajďż˝ca poďż˝ďż˝czenie z serwerem Gadu-Gadu
          *
          * @param string[optional] $statusDescription opis statusu ustawiany przy zamykaniu poďż˝ďż˝czenia
          *
          * @access public
          * @return void
        */
    public function disconnect($statusDescription = null) {

        if ($statusDescription !== null)
        fwrite($this->hSocket, pack('VVVa'.strlen($statusDescription).'C', GG_NEW_STATUS, 0x04+strlen($statusDescription),
        0x0015, $statusDescription, 0)); else
        fwrite($this->hSocket, pack('VVV', GG_NEW_STATUS, 0x04, GG_STATUS_NOT_AVAIL));
        fclose($this->hSocket);
    }

    // }}}
    // {{{ ping()
    /**
          * Wysďż˝anie pakietu PING do serwera, obowiďż˝zkowe w ciagu kaďż˝dych 5 minut, inaczej serwer
          * zakoďż˝czy polďż˝czenie
          *
          * @access public
          * @return void
        */
    public function ping() {

        fwrite($this->hSocket, pack('VV', GG_PING, 0));
    }

    // }}}
    // {{{ readPacket()
    /**
          * Odczytanie pakietu przesďż˝anego przez serwer Gadu-Gadu
          *
          * @access public
          * @return string dane pakietu
          * @see GG:handlePacket()
        */
    public function readPacket() {

        $packet = fread($this->hSocket, 8);
        if (!isset($packet{1}))
        return false;
        $packetData = unpack('Vtype/Vsize', $packet);
        if ($packetData['size'] > 0)
        $packetData['value'] = fread($this->hSocket, $packetData['size']);
        return $packetData;
    }

    // }}}
    // {{{ handlePacket()
    /**
          * Wyciďż˝gniďż˝cie szczegďż˝ďż˝w pakietu odebranego z serwera
          *
          * @param string $packet odebrany pakiet
          *
          * @access public
          * @return array tablica ze szczegďż˝ami pakietu
          * @see GG:readPacket()
        */
    public function handlePacket($packet) {

        $result = array();
        switch ($packet['type']) {
            case GG_RECV_MSG:
                $result = unpack('Vsender/Vseq/Vtime/Vclass/a'.(strlen($packet['value'])-16).'msg', $packet['value']);
                break;
            case GG_SEND_MSG_ACK:
                $result = unpack('Vstatus/Vrecipient/Vseq', $packet['value']);
                break;
            case GG_NOTIFY_REPLY:
                $result = unpack('Vuin/Cstatus/Vremote_ip/vremote_port/Vversion', $packet['value']);
                break;
            case GG_PUBDIR50_REPLY:
                $tmp = explode("\x00", substr($packet['value'], 5));
                $result = array();
                for ($nr = 0, $cnt = sizeOf($tmp)-5; $nr < $cnt; $nr += 2)
                $result[$tmp[$nr]] = $tmp[$nr+1];
                break;
        }
        return array_merge(
        array('type' => $packet['type'], 'size' => $packet['size']),
        $result
        );
    }

    // }}}
    // {{{ _fontFormat()
    /**
          * Metoda dokonujďż˝ca konwersji znacznikďż˝w HTML na format Gadu-Gadu
          *
          * @param string $string
          *
          * @access private
          * @return mixed (boolean, string)
        */
    private function _fontFormat($string) {

        $fontFormatData = array(
        'B' => GG_FONT_BOLD,
        'I' => GG_FONT_ITALIC,
        'U' => GG_FONT_UNDERLINE,
        'C' => GG_FONT_COLOR
        );
        
        if (!preg_match_all("'\\<(.*?)\\>'", $string, $aRegs, PREG_OFFSET_CAPTURE))
        return false;
        $fontData = $aRegs[0];
        $fontFormat = array();
        $a1 = 0;
        $a2 = array();
        $a3 = array();
        $b = 0;
        $d = 0;
        $cColor = '';
        for ($nr = 0, $len = sizeOf($fontData); $nr < $len; $nr++) {
            $cFontData = $fontData[$nr];
            $currentPos = $cFontData[1]-$d;
            if ($cFontData[0][1] != '/') {
                if (strlen($cFontData[0]) > 3) {
                    $cFontData[0][1] = 'C';
                    $cColor = pack('CCC', hexdec(substr($cFontData[0], 13, 2)), hexdec(substr($cFontData[0], 15, 2)),
                    hexdec(substr($cFontData[0], 17, 2)));
                    $a3[$currentPos] = $cColor;
                }
                $a1 |= $fontFormatData[$cFontData[0][1]];
                if (strlen($cColor) && $cFontData[0][1] != 'C') {
                    $a1 |= GG_FONT_COLOR;
                    $a3[$currentPos] = $cColor;
                }
                if (!isset($fontFormat[$currentPos]))
                $fontFormat[$currentPos] = $a1; else
                $fontFormat[$currentPos] = $fontFormat[$currentPos] | $a1;
                $d += strlen($cFontData[0]);
            } else {
                if (strlen($cFontData[0]) > 4)
                $cFontData[0][2] = 'C';
                $c = $fontFormatData[$cFontData[0][2]];
                $a1 ^= $c;
                $colorFul = (isset($fontFormat[$currentPos]) && $fontFormat[$currentPos] & GG_FONT_COLOR);
                $fontFormat[$currentPos] = 0;
                if (strlen($cColor) && $c != GG_FONT_COLOR) {
                    $fontFormat[$currentPos] |= GG_FONT_COLOR;
                    $a3[$currentPos] = $cColor;
                }
                if ($c == GG_FONT_COLOR) {
                    $cColor = '';
                    $fontFormat[$currentPos] |= GG_FONT_COLOR;
                    if ($colorFul) array_pop($a3);
                    $a3[$currentPos] = "\x00\x00\x00";
                }
                $fontFormat[$currentPos] |= $a1;
                $d += strlen($cFontData[0]);
            }
        }
        $b = '';
        foreach ($fontFormat as $k => $v) {
            $b .= pack('vC', $k, $v);
            if (isset($a3[$k])) $b .= $a3[$k];
        }
        return $b;
    }

    // }}}
    // {{{ _findServer()
    /**
          * Metoda pobierajaca IP oraz port serwera Gadu-Gadu
          *
          * @param integer $uid numer Gadu-Gadu uďż˝ytkownika
          *
          * @access private
          * @return mixed (boolean, string)
        */
    private function _findServer($uid) {
		$hSocket = fsockopen('appmsg.gadu-gadu.pl', 80, &$errorNumber, &$errorString, GG_CONN_TIMEOUT);
        if ($hSocket) {
            fputs($hSocket, "GET /appsvc/appmsg4.asp?fmnumber=".$uid." HTTP/1.1\r\nHost: appmsg.gadu-gadu.pl\r\n".
            "User-Agent: Mozilla/4.7 [en] (Win98; I)\r\nPragma: no-cache\r\n\r\n");
            while (($tmpData = fgets($hSocket, 128)) !== false)
            $sData = $tmpData;
            fclose($hSocket);

            if (strstr('notoperating', $sData)) return false;
            if (!ereg('(([0-9]{1,3}\.){3}[0-9]{2,3})\:([0-9]{1,5})', $sData, $aRegs) || !ip2long($aRegs[1]))
            return false;
            return array($aRegs[1], $aRegs[3]);
        }
        return false;
    }

    // }}}
    // {{{ _loginHash()
    /**
          * Metoda obliczajaca hash hasďż˝a
          *
          * @param string $password hasďż˝o uďż˝ytkownika
          * @param integer $seed klucz przesďż˝any przez serwer Gadu-Gadu
          *
          * @access private
          * @return integer
        */
    private function _loginHash($password, $seed) {

        $y = $seed;
        $x = 0;

        for ($nr = 0, $length = strlen($password); $nr < $length; $nr++) {
            $x = ($x & 0xFFFFFF00) | ord($password[$nr]);
            $y ^= $x;
            $y += $x;
            $x <<= 8;
            $y ^= $x;
            $x <<= 8;
            $y -= $x;
            $x <<= 8;
            $y ^= $x;

            $z = $y & 0x1F;
            $y1 = ($y << $z);
            if ($z < 32) {
                $y2 = $y >> 1;
                $y2 &= 0x7FFFFFFF;
                $y2 = $y2 >> (31 - $z);
            }
            $y = $y1 | $y2;
        }
        return $y;
    }
}
