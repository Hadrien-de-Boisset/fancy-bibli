<?php
    function getURL($dirPath){
        
        $currentFile = getcwd();
        return str_replace($currentFile."/", "", $dirPath);
        
    }
    
    function getIcon($fileName){
        //get file extension
        $path_parts = pathinfo($fileName);
        
            if( array_key_exists('extension', $path_parts)){
                $ext = $path_parts['extension'];
                $ext = strtolower($ext);
            } else {
                $ext = "";
            }
            
        //set an arrays per type of file
        
        $video = ["avi", "mov", "mp4", "webm", "mkv", "ogg", "ogv", "wmv"];
        
        $audio = ["mp3", "wav", "flac"];
        
        $picture = ["jpg", "jpeg", "png", "svg", "gif"];
        
        $document = ["doc", "docx", "odt", "pdf", "rtf", "txt"];
        
        $ebook = ["epub"];
        
        if(in_array($ext, $video)){
            return "<i class='far fa-file-video'></i> ";
        }
        
        if(in_array($ext, $audio)){
            return "<i class='far fa-file-audio'></i> ";
        }
        
        if(in_array($ext, $picture)){
            return "<i class='far fa-image'></i> ";
        }
        
        if(in_array($ext, $document)){
            return "<i class='far fa-file'></i> ";
        }
        
        if(in_array($ext, $ebook)){
            return "<i class='fas fa-book'></i> ";
        }
        
            
        return "<i class='far fa-question-circle'></i> ";
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
                
                $resultat .= "<li data-depth='$depth' class='unroll'><span class='dossier'><i class='fas fa-folder'></i> ".$nom."</span>".tableauContenu($dos."/".$nom, $depth+1)."</li>\n";
                
            }
            else if(is_dir($dos."/".$nom)){
                
                $resultat .= "<li data-depth='$depth'><span class='dossier dossier-vide'><i class='far fa-folder'></i> ".$nom."</span></li>\n";
                
            }
            else{
                
                $resultat .= "<li data-depth='$depth'><a href='".getURL($dos."/".$nom)."' download>".getIcon($nom).$nom."</a></li>\n";
                
            }
            
            
        }
        
        $resultat .= "</ol>\n"; //ferme la liste
        
        return $resultat;
        
    
    }
    
    
    $dossier = getcwd(); // chemin du dossier
    
    $output = tableauContenu($dossier, 0);
    
    include "bibli-utils/index.phtml";
    
   
?>
