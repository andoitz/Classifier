<?php
Class Classifier{
	public $classFolder;
	//CLASSIFIER CONFIGURATION
	private $config = array("GenericClass" => "GenericClass");
	//KERNEL CLASS LIST
	private $kernelClasses = array(	'Classifier.php',
									'GenericClass.php');
	//CLASS LIST
	protected $classes = array();
	
	function __construct( $classFolder ){
		$this->classFolder = './'.$classFolder;
		$this->includeClasses();
	}
	//INCLUDE CLASS FILES
	function includeClasses(){
		$nA = array_merge( (array) 	array('.','..'),
							(array)	$this->kernelClasses);
		include($this->classFolder.'/'.$this->config["GenericClass"].'.php');
		if($f=opendir($this->classFolder)) {
			while(false !== ($a = readdir($f))) {
				if(!in_array($a,$nA) && !is_dir($this->classFolder.'/'.$a)){
					$class = substr($a,0,strlen($a)-4);
					$this->classes[] = $class;
					include($this->classFolder.'/'.$a);
					//CREATE CLASS
					$this->$class = new $class();
				}
			}
			closedir($f);
		}
		$this->initClasses();
	}
	function initClasses(){
		foreach($this->classes as $key => $class){
			//LOAD CLASSES
			foreach($this->$class->requires as $key2 => $require){
				$this->$class->$require = $this->$require;
			}
			//INIT CLASS WHEN ALL REQUIRES ARE LOADED
			$this->$class->init();
		}
	}
}
?>