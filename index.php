<!Doctype HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="author" content="Elisabeth Azémard, M1DEV">
  <title>Panier multi-devises</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
</head>
<body>
  <?php

  // Autoloading
  require_once __DIR__ . '/vendor/autoload.php';

  // Classes utilisées
  use Currency\Produit;
  use Currency\Devise;
  use Currency\Panier;

  $devises  = new Devise(); // Récupérer les données de l'API

  // Récupérer les taux des devises voulues à partir de leur "nom"
  $dollar = 1; // devise de référence
  $euro   = $devises->getTaux("EUR");
  $livre  = $devises->getTaux("GBP");
  $yen    = $devises->getTaux("JPY");

  // Créer de nouveaux produits et les ajouter au panier
  $bonbon     = Panier::addProduit(new Produit("Bonbon",1,99.99,$euro)); // "floats in keys are truncated to integer" : any workaround?
  $chocolat   = Panier::addProduit(new Produit("Chocolat",2,69.99,$dollar));
  $gateau     = Panier::addProduit(new Produit("Gâteau",10,42,$livre));
  $crepe     = Panier::addProduit(new Produit("Crêpe",24,1.5,$yen));

  // Récupérer tous les produits du panier
  $listeProduits = Panier::getListeProduits();
  // var_dump($listeProduitsPanier);


  // Récupérer le total du panier en Dollar pour affichage
  $panierDollar = "$ ".Panier::convertPanier($dollar);
  // Récupérer le total du panier en Yen pour affichage
  $panierYen = Panier::convertPanier($yen)." ¥";
  // Récupérer le total du panier en Livre Sterling pour affichage
  $panierLivre = "£ ".Panier::convertPanier($livre);
  // Afficher le total du panier en Euro pour affichage
  $panierEuro = Panier::convertPanier($euro)." €";
  ?>

<!-- Exemple de mise en application -->
<div class="hero is-warning">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Panier multi-devises
      </h1>
      <h2 class="subtitle">
        1, 2, 3... Soleil !
      </h2>
    </div>
  </div>
</div>
<section class="section">
  <table class="table is-hoverable">
    <thead>
      <tr class="">
        <th class="has-text-centered">Produit</th>
        <th class="has-text-centered">Taux par rapport au Dollar</th>
        <th class="has-text-centered">Devise</th>
        <th class="has-text-centered">Quantité</th>
        <th class="has-text-centered">Prix unitaire</th>
        <th class="has-text-centered">Prix total</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach($listeProduits as $produit){
      echo "<tr class='has-text-centered'>
              <td class='has-text-centered'>".$produit->getNom()."</td>
              <td class='has-text-centered'>".$produit->getTauxDevise()."</td>
              <td class='has-text-centered'>".$devises->getNom($produit->getTauxDevise())."</td>
              <td class='has-text-centered'>".$produit->getQte()."</td>
              <td class='has-text-centered'>".$produit->getMontantUnitaire()."</td>
              <td class='has-text-centered'>".$produit->getMontantTotal()."</td>
            </tr>";
    }
    ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4"></td>
        <th>TOTAL EN JPY<!--EUR, USD, GBP, etc.--></th>
        <th><?php echo $panierYen; ?></th>
      </tr>
    </tfoot>
  </table>
</section>
</body>
</html>

