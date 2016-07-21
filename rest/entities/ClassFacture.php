<?php
	class Facture{
		private $numero_facture;
		private $montant;
		  
		private $numero_eleve;
		
		public function __construct(){
			

		}
		public function setNumero($numero){
			$this->numero_facture=$numero;
		}
		public function getNumero(){
			return $this->numero_facture;
		}
		public function setMontant($montant){
			$this->montant=$montant;
		}
		public function getMontant(){
			return $this->montant;
		}
		
		
		public function setNumeroEleve($numero_eleve){
			$this->numero_eleve=$numero_eleve;
		}
		public function getNumeroEleve(){
			return $this->numero_eleve;
		}
	}