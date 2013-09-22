<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Walva\SupportkotBundle\Twig;

use \Twig_Extension;
use \Walva\SupportkotBundle\Entity\Annee;

/**
 * Description of BadgeBootstrapExtension
 *
 * @author Benjamin
 */
class LabelBootstrapExtension extends Twig_Extension {

    //put your code here

    public function getFilters() {
        return array(
            'walva_label' => new \Twig_Filter_Method($this, 'getLabel'),
        );
    }
/*
 * {{ entity.lieu | label(2) | raw }}
 */
    public function getLabel($content, $color = 0) {
        if ($color == 0){
            $color = Annee::$COULEUR_BLEU;
        }
        
        $string = '<span class="%s">%s</span>';
        $class;
        
        switch ($color) {
            case Annee::$COULEUR_BLEU:
                $class = "label label-info";
                break;
            case Annee::$COULEUR_GRIS:
                $class = "label";
                break;
            case Annee::$COULEUR_NOIR:
                $class = "label label-inverse";
                break;
            case Annee::$COULEUR_ORANGE:
                $class = "label label-warning";
                break;
            case Annee::$COULEUR_ROUGE:
                $class = "label label-important";
                break;
            case Annee::$COULEUR_VERT:
                $class = "label label-success";
                break;

            default:
                break;
        }
        
        $string = sprintf($string, $class, $content);
        
        return $string;
    }

    public function getName() {
        return 'walva_label_bootstrap';
    }

}

?>
