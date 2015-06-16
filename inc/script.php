<?php

// Fonction qui recupere les images d'un repertoire, les mets à la largeur du slideshow
// Renvoie: liste des images (format inserable dans le code du slideshow)
// Parametres:
// - nom du repertoire scanné
// - nombre d'image prise (default: 4)
// - largeur du slideshow (default: 940)

// Axe d'amélioration:
// - passer en parametre une liste de fichiers à ne pas prendre en compte
function ScanDirectory4Anim($Repertoire,$nbimgdefil=4,$SlideshowImageLargeur=940){
	// definition du path
	$Directory='img/galerie/'.$Repertoire;
	$MyDirectory = opendir($Directory) or die('Erreur');$i=0;
	while($Entry = @readdir($MyDirectory)) {
		if(!is_dir($Directory.'/'.$Entry)&& $Entry!='.' && $Entry!='..' && $Entry!='.DS_Store') {
			$ListFiles[$i]=$Entry;
			$i++;
		}
	}
	closedir($MyDirectory);
	if(count($ListFiles)!=0) {
		sort($ListFiles);
	}
	$compt=0;
	$i=0;
	// count($ListFiles)
	while($i < $nbimgdefil) {
		$imgbase=$decaldos2.'img/galerie/'.$Repertoire.'/'.$ListFiles[$i];
		$imgfinal=$decaldos2.'img/galerie/'.$Repertoire.'/animation/animation-'.$ListFiles[$i];
		if(!file_exists($imgfinal)){
			redimage($imgbase,$imgfinal,$SlideshowImageLargeur,'');
		}
		$nb2=$compt%2;
		// sens qui change à chaque fois
		if($nb2==0){
			$sens='up';
		}
		else{
			$sens='down';
		}
		// affichage different pour le premier element
		if($compt==0){
			echo '{src:\''.$imgfinal.'\',dir: \''.$sens.'\'}';
		}
		else{
			echo ',{src:\''.$imgfinal.'\',dir: \''.$sens.'\'}';
		}
		$compt++;
		$i++;
	}
}

// Fonction de redimensionnement des images
function redimage($img_src,$img_dest,$dst_w,$dst_h) {
   // Lit les dimensions de l'image
   $size = GetImageSize($img_src);  
   $src_w = $size[0]; $src_h = $size[1];  
   // Teste les dimensions tenant dans la zone
   $test_h = round(($dst_w / $src_w) * $src_h);
   $test_w = round(($dst_h / $src_h) * $src_w);
   // Si Height final non précisé (0)
   if(!$dst_h) $dst_h = $test_h;
   // Sinon si Width final non précisé (0)
   elseif(!$dst_w) $dst_w = $test_w;
   // Sinon teste quel redimensionnement tient dans la zone
   elseif($test_h>$dst_h) $dst_w = $test_w;
   else $dst_h = $test_h;

   // La vignette existe ?
   $test = (file_exists($img_dest));
   // L'original a été modifié ?
   if($test)
      $test = (filemtime($img_dest)>filemtime($img_src));
   // Les dimensions de la vignette sont correctes ?
   if($test) {
      $size2 = GetImageSize($img_dest);
      $test = ($size2[0]==$dst_w);
      $test = ($size2[1]==$dst_h);
   }

   // Créer la vignette ?
   if(!$test) {
      // Crée une image vierge aux bonnes dimensions	
      $dst_im = ImageCreateTrueColor($dst_w,$dst_h); 
      // Copie dedans l'image initiale redimensionnée
      $src_im = ImageCreateFromJpeg($img_src);
      ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
      // Sauve la nouvelle image
      ImageJpeg($dst_im,$img_dest);
      // Détruis les tampons
      ImageDestroy($dst_im);
      ImageDestroy($src_im);
   }
}

?>
