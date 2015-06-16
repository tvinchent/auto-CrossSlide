# auto-CrossSlide

## MISE EN GARDE

Cross-slide n'est plus maintenu par son auteur, voir: https://github.com/tobia/CrossSlide/

## PRESENTATION

Fonction "ScanDirectory4Anim" qui recupere les images d'un repertoire indiqué, mets ces images à la largeur du slideshow
Renvoie: liste des images (format inserable dans le code du slideshow)
Parametres:
- nom du repertoire scanné
- nombre d'image prise (default: 4)
- largeur du slideshow (default: 940)

Axe d'amélioration:
- passer en parametre une liste de fichiers à ne pas prendre en compte

## HOW TO

Inserer ce code dans la page de l'animation

<div id="anim"></div>
<?php include('inc/script.php'); ?>
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/jquery.cross-slide.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){	
$('#anim').crossSlide({
  speed: 40,
  fade: 1
}, [
<?php
ScanDirectory4Anim('restaurant');
?>
]);
});
</script>

Changer les images dans le repertoire img/galerie/$rep passé en parametre (ici restaurant, soit img/galerie/restaurant)
Actualisez votre page
L'animation s'est à jour avec les nouvelles images automatiquement