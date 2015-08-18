<?php
namespace App\Http\Traits;

trait ReturnAssoc {
	public function getAssocValues (array $data = array()) {
        
        $return = [];
        foreach ($data as $key => $values) {
           $return[$key] = $values['title'];
        }

        return $return;
    }
}