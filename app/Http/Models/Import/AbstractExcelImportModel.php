<?php
abstract class AbstractExcelImportModel extends \Excel\AbstractExcelImport {
	/**
	 * [initRun description]
	 * 
	 * @return [type] [description]
	 */
	protected function initRun () {
		parent::initRun();		
	}
	/**
	 * [encode description]
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	protected function encode ($value) {
		$value = trim($value);
		return htmlspecialchars($value, ENT_QUOTES);
	}
	/**
	 * Check if the values of the selected and current differ
	 * 
	 * @param  array  $fields   [description]
	 * @param  [type] $selected [description]
	 * @param  [type] $current  [description]
	 * @return [type]           [description]
	 */
	protected function valuesDiff (array $fields, $selected, $current) {
		foreach ($fields as $key) {
			//Key is present in both the selected and current
			if (isset($selected->{$key}) && isset($current->{$key})){
				//The value of the selected is not th same as the current
				if ($selected->{$key} != $current->{$key}) {
					return true;
				}
			} else {
				return true;
			}
		}

		return false;
	}
}