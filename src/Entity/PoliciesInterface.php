<?php

namespace Drupal\kong\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Policies entities.
 *
 * @ingroup kong
 */
interface PoliciesInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Policies name.
   *
   * @return string
   *   Name of the Policies.
   */
  public function getName();

  /**
   * Sets the Policies name.
   *
   * @param string $name
   *   The Policies name.
   *
   * @return \Drupal\kong\Entity\PoliciesInterface
   *   The called Policies entity.
   */
  public function setName($name);

  /**
   * Gets the Policies creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Policies.
   */
  public function getCreatedTime();

  /**
   * Sets the Policies creation timestamp.
   *
   * @param int $timestamp
   *   The Policies creation timestamp.
   *
   * @return \Drupal\kong\Entity\PoliciesInterface
   *   The called Policies entity.
   */
  public function setCreatedTime($timestamp);

}
