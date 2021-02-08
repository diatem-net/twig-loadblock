<?php

namespace Drupal\twig_loadblock\TwigExtension;

use Drupal\block\Entity\Block;

class LoadBlock extends \Twig_Extension
{

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return 'twig_loadblock.twig_extension';
  }

    /**
    * Generates a list of all Twig functions that this extension defines.
    */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
              'loadBlock',
              array($this, 'loadBlock'),
              array('is_safe' => array('html'))
            )
        );
    }


  public static function loadBlock($name) {
    $block = Block::load($name);
    $block_content = \Drupal::entityTypeManager()->getViewBuilder('block')->view($block);

    return array('#markup' => \Drupal::service('renderer')->render($block_content));
  }

}
