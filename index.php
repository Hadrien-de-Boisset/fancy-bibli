<?php
    function getURL($dirPath){
        
        $currentFile = getcwd();
        return str_replace($currentFile."/", "", $dirPath);
        
    }
    
    function tableauContenu($dos, $depth){
   
    
        $fichiers = scandir($dos); // crée un tableau php qui contient la liste des fichiers
        
        $fichiers = array_diff($fichiers, array('..', '.','index.php', 'bibli-utils')); // si le serveur utilise linux, enlève les pseudo-fichiers de navigation "." et ".."
        
        if(empty($fichiers)){
            
            return false;
            
        }
        
        $fichiers = array_values ( $fichiers ); // renumérotte tout au cas ou la ligne d'avant à enlevé des lignes innutiles

        $resultat = "\n<ol>\n"; //ouvre la liste
        
        foreach($fichiers as $nom){
            
            if(is_dir($dos."/".$nom) && !empty(array_diff(scandir($dos."/".$nom), array('..', '.')))){
                
                $resultat .= "<li data-depth='$depth' class='unroll'><span class='dossier'>".$nom."</span>".tableauContenu($dos."/".$nom, $depth+1)."</li>\n";
                
            }
            else if(is_dir($dos."/".$nom)){
                
                $resultat .= "<li data-depth='$depth'><span class='dossier dossier-vide'>".$nom."</span></li>\n";
                
            }
            else{
                
                $resultat .= "<li data-depth='$depth'><a href='".getURL($dos."/".$nom)."' download>".$nom."</a></li>\n";
                
            }
            
            
        }
        
        $resultat .= "</ol>\n"; //ferme la liste
        
        return $resultat;
        
    
    }
    
    
    $dossier = getcwd(); // chemin du dossier
    
    $output = tableauContenu($dossier, 0);
    
    include "bibli-utils/index.phtml";
    
   
?>
