<?php
	class Eleve{
		private $numero_eleve;
		private $nom;
		private $prenom;
		private $adresse;
		private $lieu_naissance;
		private $tuteur;
		private $date_naissance;
        private $civilite;
		private $boursier;
		private $id_transport;
		  
		
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
		public function setAdresse($adresse){
			$this->adresse=$adresse;
		}
		public function getAdresse(){
			return $this->adresse;
		}
		public function setLieu($lieu){
			$this->lieu=$lieu;
		}
		public function getLieu(){
			return $this->lieu;
		}
		public function setTuteur($tuteur){
			$this->tuteur=$tuteur;
		}
		public function getTuteur(){
			return $this->tuteur;
		}
		public function setDateNaissance($datenaissance){
			$this->datenaissance=$datenaissance;
		}
		public function getDateNaissance(){
			return $this->datenaissance;
		}
		public function setCivilite($civilite){
			$this->civilite=$civilite;
		}
		public function getCivilite(){
			return $this->civilite;
		}
		public function setBoursier($boursier){
			$this->boursier=$boursier;
		}
		public function getBoursier(){
			return $this->boursier;
		}
		public function setTransport($id_transport){
			$this->id_transport=$id_transport;
		}
		public function getTransport(){
			return $this->id_transport;
		}
		
	}