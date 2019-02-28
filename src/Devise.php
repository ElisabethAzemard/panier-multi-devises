<?php

namespace Currency;

class Devise {

  private $listeDevises;

  public function __construct(){ // API
    $json = file_get_contents("https://api.exchangeratesapi.io/latest?base=USD&symbols=GBP,EUR,JPY");
    $this->listeDevises = json_decode($json, true);
  }

  public function getTaux($nomDevise){
    foreach($this->listeDevises as $devise){
      foreach($devise as $nom => $taux){
        if($nomDevise == $nom){
          return $taux;
        }
      }
    }
  }

  public function getNom($tauxDevise){
    foreach($this->listeDevises['rates'] as $devise => $taux){
        if($tauxDevise == $taux){
          return $devise;
        } elseif ($tauxDevise == 1) {
          return $this->listeDevises["base"];
        }
      }
    }

}
