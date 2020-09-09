<?php

namespace Drupal\kong\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Policies entity.
 *
 * @ingroup kong
 *
 * @ContentEntityType(
 *   id = "policies",
 *   label = @Translation("Policies"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\kong\PoliciesListBuilder",
 *     "views_data" = "Drupal\kong\Entity\PoliciesViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\kong\Form\PoliciesForm",
 *       "add" = "Drupal\kong\Form\PoliciesForm",
 *       "edit" = "Drupal\kong\Form\PoliciesForm",
 *       "delete" = "Drupal\kong\Form\PoliciesDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\kong\PoliciesHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\kong\PoliciesAccessControlHandler",
 *   },
 *   base_table = "policies",
 *   translatable = FALSE,
 *   admin_permission = "administer policies entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/policies/{policies}",
 *     "add-form" = "/admin/structure/policies/add",
 *     "edit-form" = "/admin/structure/policies/{policies}/edit",
 *     "delete-form" = "/admin/structure/policies/{policies}/delete",
 *     "collection" = "/admin/structure/policies",
 *   },
 *   field_ui_base_route = "policies.settings"
 * )
 */
class Policies extends ContentEntityBase implements PoliciesInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  public function setExternalIdentifier($id) {
    $this->set('external_identifier', $id);
    return $this;
  }

  public function getExternalIdentifier() {
    return $this->get('external_identifier')->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Policies entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['description'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Description'))
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['status']->setDescription(t('A boolean indicating whether the Policies is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['type'] = BaseFieldDefinition::create('list_string')
      ->setSettings([
        'allowed_values' => [
          'rate_limiting' => 'Rate limiting',
          'authn' => 'Authentication',
        ]
      ])
      ->setLabel(t('Type'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['proxy'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Proxy'))
      ->setDescription(t('The Name of the associated Proxy.'))
      ->setSetting('target_type', 'proxy')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'entity_reference_label',
        'weight' => -3,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['rate_limiting'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Rate Limiting'))
      ->setDescription(t('Enter the rate limiting/minute.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);


    $fields['external_identifier'] = BaseFieldDefinition::create('string')
      ->setLabel(t('External Identifier'))
      ->setDescription(t('External Identifier.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
