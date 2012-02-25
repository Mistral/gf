<?php

class gfUpload {

    public function loadFile($sName, $sLocation) {
        if (move_uploaded_file($_FILES[$sName]['tmp_name'], $sLocation)) {
            return true;
        } else {
            return false;
        }
    }

}

?>