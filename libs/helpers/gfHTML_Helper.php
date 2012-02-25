<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 0.0.1
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.helpers.gfHTML_Helper
 * 
 */

interface igfHTML_Helper_Forms {
    public function addForm($name, $to, $method, $nazwa, $action = '');
    public function closeForm();
    public function addInput($sType, $sName, $sId, $sNazwa, array $aOption = array('40'));
    public function addToken();
    public function addSubmitAndReset($reset_name, $submit_name);
}


/**
 * Stala formularza textu
 *
 */
gfRunner::setConstans('gfHTML_TEXT', 'input/text', array('infile' => __FILE__, 'inline' => __LINE__));

/**
 * Stala formularza hasla
 *
 */
gfRunner::setConstans('gfHTML_PASSWORD', 'input/password', array('infile' => __FILE__, 'inline' => __LINE__));

/**
 * Stala formularza pola wyboru
 *
 */
gfRunner::setConstans('gfHTML_SELECT', 'input/select', array('infile' => __FILE__, 'inline' => __LINE__));

/**
 * Stala formularza pola tekstowego
 *
 */
gfRunner::setConstans('gfHTML_TEXTAREA', 'input/area', array('infile' => __FILE__, 'inline' => __LINE__));

/**
 * Stala formularza pola radio
 *
 */
gfRunner::setConstans('gfHTML_RADIO', 'input/radio', array('infile' => __FILE__, 'inline' => __LINE__));

/**
 * Stala formularza pola checkbox
 *
 */
gfRunner::setConstans('gfHTML_CHECKBOX', 'input/checkbox', array('infile' => __FILE__, 'inline' => __LINE__));


class gfHTML_Helper implements igfHTML_Helper_Forms {

    /**
     * Przechowuje kody zbudowanych inputow
     *
     * @var array
     */
    protected $__aInput = array();
    
    /**
     * Przechowuje kody tabel
     *
     * @var array
     */
    protected $__aTables = array();

    /**
     * Konstruktor
     *
     */
    public function __construct() {

    }

    /**
     * Niszczy zbudowane inputy
     *
     */
    public function __destruct() {
        unset($this -> __aInput);
    }

    /**
     * Dodaje formularz
     *
     * @param string $name
     * @param string $to
     * @param string $method
     * @param string $action
     * @return string
     */
    public function addForm($sName, $sTo, $sMethod, $nazwa, $sAction = '') {
        $sTag_form = '<form action="'.$sTo.'" method="'.$sMethod.'" class="'.strtolower($sName).'" '.$sAction.'>
        			  <fieldset>
        			  <div class="legend"><h3>'.$nazwa.'</h3></div> ';
        return $sTag_form;
    }
    
    public function addToken() {
        return $this -> addInput(gfHTML_TEXT, 'token', 'form_text', '<img src="'.gf_DOMAIN.'/imagebuilder.php" border="0" />', array('default' => ''));
    }
    
    public function addFormFile($sName, $sTo, $sMethod, $sAction = '') {
    	return '<form enctype="multipart/form-data" action="'.$sTo.'" method="'.$sMethod.'" class="'.strtolower($sName).'" '.$sAction.'><fieldset> ';
    }
    
    public function addFormFileEnd($sSubmit_name, $sReset_name) {
    	return $this -> addSubmitAndReset($sSubmit_name, $sReset_name);
    }
    
    public function addFileInput($sTopic, $sName) {
    	$sTag = '<tr><td>'.$sTopic.'</td>
    			 <td><input name="'.$sName.'" type="file" /></td></tr>';
        return $sTag;
    }

    /**
     * Zamyka obramownie formularza
     *
     * @return string
     */
    public function closeForm() {
        return '</fieldset> </form>';
    }

    /**
     * Pobiera informaje o przyciskach
     *
     * @param string $type
     * @param string $name
     * @param string $id
     * @param string $nazwa
     * @param array $option
     */
    protected function __getInputInfo($cType, $sName, $iId, $sNazwa, array $aOption = array('size' => '40')) {
        $this -> __aInput = array(); // reset
        $sType_input = '';
        switch ($cType) {
            case gfHTML_TEXT:
                $sType_input = 'text';
                $this -> __aInput['type'] = $sType_input;
                $this -> __aInput['name'] = $sName;
                @$this -> __aInput['options'] = $aOption;
                $this -> __aInput['nazwa'] = $sNazwa;
                $this -> __aInput['id'] = $iId;
                break;
            case gfHTML_PASSWORD:
                $sType_input = 'password';
                $this -> __aInput['type'] = $sType_input;
                $this -> __aInput['name'] = $sName;
                @$this -> __aInput['options'] = $aOption;
                $this -> __aInput['nazwa'] = $sNazwa;
                $this -> __aInput['id'] = $iId;
                break;
            case gfHTML_SELECT:
                $sType_input = 'select';
                $this -> __aInput['type'] = $sType_input;
                $this -> __aInput['name'] = $sName;
                $this -> __aInput['value'] = (@$aOption['value']) ? $aOption['value'] : '';
                $this -> __aInput['size'] = (@$aOption['size']) ? $aOption['size'] : 40;
                $this -> __aInput['select'] = ($aOption['select']) ? $aOption['select'] : 'ERROR';
                @$this -> __aInput['options'] = $aOption;
                $this -> __aInput['nazwa'] = $sNazwa;
                $this -> __aInput['id'] = $iId;
                break;
            case gfHTML_TEXTAREA:
                $sType_input = 'textarea';
                $this -> __aInput['type'] = $sType_input;
                $this -> __aInput['name'] = $sName;
                @$this -> __aInput['options'] = $aOption;
                $this -> __aInput['value'] = (@$aOption['value']) ? $aOption['value'] : '';
                $this -> __aInput['nazwa'] = $sNazwa;
                $this -> __aInput['id'] = $iId;
                break;
            case gfHTML_RADIO:
                $sType_input = 'radio';
                $this -> __aInput['type'] = $sType_input;
                $this -> __aInput['name'] = $sName;
                $this -> __aInput['value'] = ($aOption['value']) ? $aOption['value'] : '';
                $this -> __aInput['radio'] = ($aOption['radio']) ? $aOption['radio'] : 'ERROR';
                $this -> __aInput['nazwa'] = $sNazwa;
                $this -> __aInput['id'] = $iId;
                break;
            case gfHTML_CHECKBOX:
                $sType_input = 'checkbox';
                $this -> __aInput['type'] = $sType_input;
                $this -> __aInput['name'] = $sName;
                $this -> __aInput['options'] = $aOption;
                $this -> __aInput['nazwa'] = $sNazwa;
                $this -> __aInput['id'] = $iId;
                break;
            default:
                $sType_input = 'text';
                $this -> __aInput['type'] = $sType_input;
                $this -> __aInput['name'] = $sName;
                $this -> __aInput['value'] = ($aOption['value']) ? $aOption['value'] : '';
                $this -> __aInput['size'] = ($aOption['size']) ? $aOption['size'] : 40;
                $this -> __aInput['nazwa'] = $sNazwa;
                $this -> __aInput['id'] = $iId;
                break;
        }
    }

    /**
     * Dodaje przycisk
     *
     * @param string $type
     * @param string $name
     * @param string $id
     * @param string $nazwa
     * @param array $option
     * @return string
     */
    public function addInput($sType, $sName, $sId, $sNazwa, array $aOption = array('40')) {
        if(!$this -> __aInput) {
            $this -> __getInputInfo($sType, $sName, $sId, $sNazwa, $aOption);
        }
        $this -> __buildInput();
        $sInput = $this -> __aInput['code'];
        $this -> __aInput = array();
        return $sInput;
    }

    /**
     * Buduje pole textu
     *
     */
    protected function __buildInputText() {	
        $sTag = '<div class="form_row" id="id_value_'.strtolower($this -> __aInput['name']).'"><div class="form_property">'.$this -> __aInput['nazwa'].'</div>
        <div class="form_value"><input type="'.$this -> __aInput['type'].'" id="'.$this -> __aInput['id'].'" name="'.strtolower($this -> __aInput['name']).'"';
        if(count($this -> __aInput['options']) >= 1) {
        	foreach($this -> __aInput['options'] as $k => $v) {
				$sTag .= ' '.$k.'="'.$v.'"';
			}
        }
        $sTag .= ' /></div><div id="notice_'.strtolower($this -> __aInput['name']).'" class="notice_form"></div>
        <div class="clearer">&nbsp;</div>
        </div>';
        $this -> __aInput['code'] = $sTag;
        unset($sTag);
    }

    /**
     * Buduje pole hasla
     *
     */
    protected function __buildInputPassword() {
        $sTag = '<div class="form_row" id="id_value_'.strtolower($this -> __aInput['name']).'"><div class="form_property" id="id_value_'.strtolower($this -> __aInput['name']).'">'.$this -> __aInput['nazwa'].'</div>
        <div class="form_value"><input type="'.$this -> __aInput['type'].'" id="'.$this -> __aInput['id'].'" name="'.strtolower($this -> __aInput['name']).'"';
        if(count($this -> __aInput['options']) >= 1) {
        	foreach($this -> __aInput['options'] as $k => $v) {
				$sTag .= ' '.$k.'="'.$v.'"';
			}
        }
        $sTag .= ' /></div><div id="notice_'.strtolower($this -> __aInput['name']).'" class="form_property"></div>
        <div class="clearer">&nbsp;</div>
        </div>';
        $this -> __aInput['code'] = $sTag;
    }

    /**
     * Buduje pole wyboru
     *
     */
    protected function __buildInputSelect() {
        $aOptions = $this -> __aInput['select'];
        $sOption = '';
        foreach($aOptions as $k => $v) {
            $sOption .= '<option value="'.$k.'">'.$v.'</option>';
        }
        $sTag = '<div class="form_row" id="id_value_'.strtolower($this -> __aInput['name']).'"><div class="form_property">'.$this -> __aInput['nazwa'].'</div>
        <div class="form_value"><select name="'.strtolower($this -> __aInput['name']).'">'.$sOption.'</div><div id="notice_'.strtolower($this -> __aInput['name']).'" class="form_property"></div>
        <div class="clearer">&nbsp;</div>
        </div>';
        $this -> __aInput['code'] = $sTag;
        unset($sTag);
    }

    /**
     * Buduje pole pola tekstowego
     *
     */
    protected function __buildInputTextarea() {
        $aWymiary = explode('/', $this -> __aInput['options']['size']);
        unset($this -> __aInput['options']['size']);
        $sTag = '<div class="form_row" id="id_value_'.strtolower($this -> __aInput['name']).'"><div class="form_property">'.$this -> __aInput['nazwa'].'</div>
        <div class="form_value"><textarea id="'.$this -> __aInput['id'].'" name="'.strtolower($this -> __aInput['name']).'" cols="'.$aWymiary[0].'" rows="'.$aWymiary[1].'"';
    	foreach($this -> __aInput['options'] as $k => $v) {
			$sTag .= ' '.$k.'="'.$v.'"';
		}
        $sTag .= '>'.$this -> __aInput['value'].'</textarea></div><div id="notice_'.strtolower($this -> __aInput['name']).'" class="form_property"></div>
        <div class="clearer">&nbsp;</div>
        </div>';
        $this -> __aInput['code'] = $sTag;
        unset($sTag);
    }

    /**
     * Buduje pole radio
     *
     */
    protected function __buildInputRadio() {
        $aRadio = explode(';', $this -> __aInput['radio']);
        $sRadio = '<div class="form_row" id="id_value_'.strtolower($this -> __aInput['name']).'">';
        foreach($aRadio as $w) {
            $sRadio .= $w.'<div class="form_property">'.$this -> __aInput['nazwa'].'</div><div class="form_value"><input type="radio" id="'.$this -> __aInput['id'].'" name="'.strtolower($this -> __aInput['name']).'" value="'.$this -> __aInput['value'].'"></div> 
        <div class="clearer">&nbsp;</div>
        </div>';
        }
        $sRadio .= '<div id="'.strtolower($this -> __aInput['name']).'"></div><div class="clearer">&nbsp;</div>
        </div>';
        $this -> __aInput['code'] = $sRadio;
        unset($sRadio);
    }

    /**
     * Buduje pole checkbox
     *
     */
    protected function __buildInputCheckbox() {
        $sBox = '<div class="form_row" id="id_value_'.strtolower($this -> __aInput['name']).'"><div class="form_property">'.$this -> __aInput['nazwa'].'</div>
            <div class="form_value"><input type="checkbox" name="'.$this -> __aInput['name'].'" value="'.$this -> __aInput['options']['value'].'" /></div><div id="notice_'.strtolower($this -> __aInput['name']).'" class="form_property"></div><div class="clearer">&nbsp;</div>
        </div>';
        $this -> __aInput['code'] = $sBox;
        unset($sBox);
    }

    /**
     * Buduje pole
     *
     */
    protected function __buildInput() {
        if(!$this -> __aInput) {
        } else {
            switch($this -> __aInput['type']) {
                case 'text':
                    $this -> __buildInputText();
                    break;
                case 'password':
                    $this -> __buildInputPassword();
                    break;
                case 'select':
                    $this -> __buildInputSelect();
                    break;
                case 'textarea':
                    $this -> __buildInputTextarea();
                    break;
                case 'radio':
                    $this -> __buildInputRadio();
                    break;
                case 'checkbox':
                    $this -> __buildInputCheckbox();
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * Buduje przycisk wyslania i resetu
     *
     * @param string $submit_name
     * @param string $reset_name
     * @return string
     */
    public function addSubmitAndReset($sSubmit_name, $sReset_name) {
        $this -> __buildSubmit($sSubmit_name);
        $this -> __buildReset($sReset_name);
        return $this -> __aInput['reset'] . $this -> __aInput['submit'];
    }

    /**
     * Buduje przycisk submit
     *
     * @param string $name
     */
    protected function __buildSubmit($sName) {
        $sTag = '<input type="submit" name="submit" value="'.$sName.'" class="" /></div><div id="notice_submit" class="form_property"></div><div class="clearer">&nbsp;</div></div>';
        $this -> __aInput['submit'] = $sTag;
        unset($sTag);
    }

    /**
     * Buduje przycisk resetu
     *
     * @param string $name
     */
    protected function __buildReset($sName) {
        $sTag = '<div class="form_row form_row_submit" id="id_value_submit"><div class="form_value"><input type="reset" name="resetbutton" value="'.$sName.'" class="" />';
        $this -> __aInput['reset'] = $sTag;
        unset($sTag);
    }

}
?>