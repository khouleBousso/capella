<?php
	class Transport{
		private $id_transport;
		private $code_transport;
		private $mensualite;
		
		public function __construct(){
			

		}
		public function setId($numero){
			$this->id_transport=$numero;
		}
		public function getId(){
			return $this->id_transport;
		}
		public function setCode_transport($code){
			$this->code_transport=$code;
		}
		public function getCode_transport(){
			return $this->code_transport;
		}
		
		
		public function setMensualite($mensualite){
			$this->mensualite=$mensualite;
		}
		public function getMensualite(){
			return $this->mensualite;
		}
	}