<?php

namespace Drupal\kong\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Apigateway entities.
 *
 * @ingroup kong
 */
interface APIGatewayInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Apigateway name.
   *
   * @return string
   *   Name of the Apigateway.
   */
  public function getName();

  /**
   * Sets the Apigateway name.
   *
   * @param string $name
   *   The Apigateway name.
   *
   * @return \Drupal\kong\Entity\APIGatewayInterface
   *   The called Apigateway entity.
   */
  public function setName($name);

  /**
   * Gets the Apigateway creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Apigateway.
   */
  public function getCreatedTime();

  /**
   * Sets the Apigateway creation timestamp.
   *
   * @param int $timestamp
   *   The Apigateway creation timestamp.
   *
   * @return \Drupal\kong\Entity\APIGatewayInterface
   *   The called Apigateway entity.
   */
  public function setCreatedTime($timestamp);

}
