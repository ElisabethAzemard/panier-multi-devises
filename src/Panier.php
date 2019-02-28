<?php

namespace Currency;

class Panier {

  private static $listeProduits = [];

  // GETTER
  public static function getListeProduits(){
    return self::$listeProduits;
  }

  // MÉTHODES - CALCULS
  public static function addProduit(Produit $produit){
    return array_push(self::$listeProduits, $produit);
  }

  public static function convertPanier($tauxDeviseCible){
    $montantTotalUSD = 0; // évite le "Notice: undefined variable:"
    foreach(self::$listeProduits as $produit){
      $montant = $produit->getMontantTotal();
      $taux = $produit->getTauxDevise();
      $montantTotalUSD += $montant / $taux;
    }
    return round($montantTotalUSD * $tauxDeviseCible, 2);
  }

}