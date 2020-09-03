<?php

/**
 * @file
 * Contains policies.page.inc.
 *
 * Page callback for Policies entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Policies templates.
 *
 * Default template: policies.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_policies(array &$variables) {
  // Fetch Policies Entity Object.
  $policies = $variables['elements']['#policies'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
