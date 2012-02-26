<?php
class gfModelForm {

    public $errors;

    public function  addValider() {
        require_once(gf_CORE_PATH.'/gfValidatorForms.php');
    }

    public function getType() {
        return 'form';
    }
}
?>
