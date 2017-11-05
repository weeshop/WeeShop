<?php

namespace Drupal\catshop_frontpage\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for the home page.
 */
class HomeController extends ControllerBase
{
    /**
     * Display the markup.
     *
     * @return array
     */
    public function content() {
        return array(
            '#type' => 'markup',
            '#markup' => $this->t('Hello, World!!!'),
        );
    }
}
