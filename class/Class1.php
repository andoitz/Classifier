<?php
Class Class1 extends GenericClass{
	function __construct(){
		parent::__construct();
		$this->requires[] = 'Class2';
	}
	function init(){
		echo 'Class1 load example with requires:<br/>';
		echo var_export($this->requires,true).'<br/>';
	}
}
?>