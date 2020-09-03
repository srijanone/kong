<?php

namespace Drupal\kong\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

Class KongSettingsForm extends ConfigFormBase
{

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'kong.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'kong_gateway_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config(static::SETTINGS);

    $form['kong_admin_api_settings'] = [
      '#type' => 'fieldset',
      '#title' => $this
        ->t('Kong Admin API Settings'),
    ];

    $form['kong_admin_api_settings']['kong_admin_api_host'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Kong Admin API Host'),
      '#default_value' => $config->get('kong_admin_api_host'),
    ];

    $form['kong_admin_api_settings']['kong_admin_api_port'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Kong Admin API Port'),
      '#default_value' => $config->get('kong_admin_api_port'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->configFactory->getEditable(static::SETTINGS)
      ->set('kong_admin_api_host', $form_state->getValue('kong_admin_api_host'))
      ->set('kong_admin_api_port', $form_state->getValue('kong_admin_api_port'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
