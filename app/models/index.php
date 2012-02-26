<?php
class indexModel extends gfModelForm {

    public function x() {
        return 'asdf';
    }

    public function validFormIndex() {
        $form = new gfValidatorForms();
        $form->addField('name', 'length', '10,15');
        $form->addField('content', 'notempty');
        if(!$form->valid()) {
            //$this->errors = $form->getErrors();
            return false;
        }
        return true;
    }
}
?>
