<?php

namespace Drupal\kong\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use TheRealGambo\Kong\Kong;

Class KongProxyForm extends ConfigFormBase
{

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'kong.proxy';

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'kong_gateway_proxy_form';
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

    $form['kong_proxy_settings'] = [
      '#type' => 'fieldset',
      '#title' => $this
        ->t('Kong Proxy Settings'),
    ];

    $form['kong_proxy_settings']['kong_proxy_path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Kong Admin API Host'),
      '#default_value' => $config->get('kong_proxy_path'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {


    $this->configFactory->getEditable(static::SETTINGS)
      ->set('kong_proxy_path', $form_state->getValue('kong_proxy_path'))
      ->save();
    parent::submitForm($form, $form_state);

  }

}
