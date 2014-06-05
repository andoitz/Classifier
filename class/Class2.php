<?php
Class Class2 extends GenericClass{
	function __construct(){
		parent::__construct();
		$this->requires[] = 'Class1';
	}
	function init(){
		echo 'Class2 load example with requires:<br/>';
		echo var_export($this->requires,true).'<br/>';
	}
}
?>