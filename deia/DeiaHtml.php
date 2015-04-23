<?php

/**
 * Classe de construção de elementos html
 */
class DeiaHtml extends DeiaController{
    public function __construct(){
        parent::__construct(true);
    }

    public static function img($src,$title=null){
        if($src){
            return "<img src='$src' title='$title'></img>";
        }else{
            throw new InvalidArgumentException("Argumento [object] inválido ou não informado:::img DeiaHtml src=$src");
        }
    }

    public static function a($href, $label, $class=null, $title=null){
        return "<a href='$href' class='$class' title=''>$label</a>";
    }
}
