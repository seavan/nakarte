<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class Guid {
    // Generate Guid
    static public function NewGuid() {
        $s = strtoupper(md5(uniqid(rand(),true)));
        $guidText =
                substr($s,0,8) . '-' .
                substr($s,8,4) . '-' .
                substr($s,12,4). '-' .
                substr($s,16,4). '-' .
                substr($s,20);
        return $guidText;
    }
    
}
?>
