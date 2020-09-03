<?php

namespace Drupal\kong;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Policies entity.
 *
 * @see \Drupal\kong\Entity\Policies.
 */
class PoliciesAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\kong\Entity\PoliciesInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished policies entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published policies entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit policies entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete policies entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add policies entities');
  }


}
