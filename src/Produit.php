<?php

namespace Currency;

class Produit {

  private $nom;
  private $quantite;
  private $prix = [];

  // CONSTRUCTEUR
  public function __construct($nom, $quantite, $montant, $taux){
    $this->nom = $nom;
    $this->quantite = $quantite;
    $this->prix[$montant] = $taux;
  }

  // GETTTERS
  public function getNom(){
    return $this->nom;
  }

  public function getQte(){
    return $this->quantite;
  }

  public function getMontantUnitaire(){
    foreach($this->prix as $montant => $tauxDevise){
      return $montant;
    }
  }

  public function getMontantTotal(){
    foreach($this->prix as $montant => $tauxDevise){
      $qte = $this->quantite;
      return $montant * $qte;
    }
  }

  public function getTauxDevise(){
    foreach($this->prix as $montant => $tauxDevise){
      return $tauxDevise;
    }
  }

}