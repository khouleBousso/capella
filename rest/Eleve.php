<?php
	class Eleve{
		private $numero_eleve;
		private $nom;
		private $prenom;
		  
		
		public function __construct(){
			

		}
		public function setNumero($numero){
			$this->numero_eleve=$numero;
		}
		public function getNumero(){
			return $this->numero_eleve;
		}
		public function setNom($nom){
			$this->nom=$nom;
		}
		public function getNom(){
			return $this->nom;
		}
		
		public function setPrenom($prenom){
			$this->prenom=$prenom;
		}
		public function getPrenom(){
			return $this->prenom;
		}
		
		
		
		
		
	}