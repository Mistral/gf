<?php
class gfValidatorForms {

    private $fields;
    private $errors;
    private $valider;

    public function addField($name, $valid, $descvalid = 'nodesc') {
        $this->fields[$name] = array('type' => $valid, 'desc' => $descvalid);
    }

    public function valid() {
        require_once(gf_LIBS_PATH.'/gfValidate.php');
        $this->valider = new gfValidate();
        $post = gf::request()->getPost();
        foreach($this->fields as $name => $valid) {
            if($valid['type'] == 'length') {
                $m = explode(',', $valid['desc']);
                if(!$this->checkLength($post[$name], $m[0], $m[1])) {
                    $this->addError($name, 'length');
                }
            } else if($valid['type'] == 'notempty') {
                if(!$this->checkNotEmpty($post[$name])) {
                    $this->addError($name, 'empty');
                }
            } else if($valid['type'] == 'match') {
                if(!$this->checkMatch($post[$name], $post[$valid['desc']])) {
                    $this->addError($name, 'match');
                }
            } else if($valid['type'] == 'equal') {
                if(!$this->checkEqual($post[$name], $post[$valid['desc']])) {
                    $this->addError($name, 'equal');
                }
            } else if($valid['type'] == 'email') {
                if(!$this->checkEmail($post[$name])) {
                    $this->addError($name, 'email');
                }
            } else if($valid['type'] == 'name') {
                if(!$this->checkName($post[$name])) {
                    $this->addError($name, 'name');
                }
            } else if($valid['type'] == 'url') {
                if(!$this->checkUrl($post[$name])) {
                    $this->addError($name, 'url');
                }
            } else if($valid['type'] == 'postcode') {
                if(!$this->checkPostCode($post[$name])) {
                    $this->addError($name, 'postcode');
                }
            }

        }

        if(count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    public function checkLength($content, $min, $max) {
        if($this->valider->getLength($content) >= $min && $this->valider->getLength($content) <= $max) {
            return true;
        }
        return false;
    }

    public function checkNotEmpty($content) {
        if($this->valider->getLength($content) > 0) {
            return true;
        }
        return false;
    }

    public function checkMatch($content1, $content2) {
        if($this->valider->matchEqual($content1, $content2)) {
            return true;
        }
        return false;
    }

    public function checkEqual($int1, $int2) {
        if($this->valider->isEqualInt($int1, $int2)) {
            return true;
        }
        return false;
    }

    public function checkEmail($content) {
        if($this->valider->valid($content, gfValidate::EMAIL)) {
            return true;
        }
        return false;
    }

    public function checkName($content) {
        if($this->valider->valid($content, gfValidate::NAME)) {
            return true;
        }
        return false;
    }

    public function checkUrl($content) {
        if($this->valider->valid($content, gfValidate::URL)) {
            return true;
        }
        return false;
    }

    public function checkPostCode($content) {
        if($this->valider->valid($content, gfValidate::POST_CODE)) {
            return true;
        }
        return false;
    }

    public function addError($field, $type) {
        $this->errors[] = array($field => $type);
    }

    public function getErrors() {
        return $this->errors;
    }

}
?>
