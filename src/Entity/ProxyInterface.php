<?php

namespace Drupal\kong\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Proxy entities.
 *
 * @ingroup kong
 */
interface ProxyInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Proxy name.
   *
   * @return string
   *   Name of the Proxy.
   */
  public function getName();

  /**
   * Sets the Proxy name.
   *
   * @param string $name
   *   The Proxy name.
   *
   * @return \Drupal\kong\Entity\ProxyInterface
   *   The called Proxy entity.
   */
  public function setName($name);

  /**
   * Gets the Proxy creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Proxy.
   */
  public function getCreatedTime();

  /**
   * Sets the Proxy creation timestamp.
   *
   * @param int $timestamp
   *   The Proxy creation timestamp.
   *
   * @return \Drupal\kong\Entity\ProxyInterface
   *   The called Proxy entity.
   */
  public function setCreatedTime($timestamp);

}
