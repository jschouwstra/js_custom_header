<?php
namespace Drupal\js_custom_header\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 * @Block(
 *   id = "js_custom_header_block",
 *   admin_label = @Translation("Custom Header"),
 *   category = @Translation("Custom Header"),
 * )
 */
class CustomHeaderBlock extends BlockBase implements BlockPluginInterface{
    public function build(){
        $config = $this->getConfiguration();

        if (!empty($config['textValue'])) {
            $header_text = $config['textValue'];
        } else {
            $header_text = $this->t('');
        }

        //Render template with variables
        return array(
            '#theme' => 'custom-header-block',
            '#textValue' => $header_text,

        );
    }


    public function blockForm($form, FormStateInterface $form_state){
        $config = $this->getConfiguration();
        //New form
        $form = parent::blockForm($form, $form_state);
//        $form['colorpicker']['#attached']['library'][] = 'js_fullwidth/colorpicker';


        $form['textValue'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Header Text'),
            '#default_value' => isset($config['textValue']) ? $config['textValue'] : '',
        );

        return $form;

    }


    public function blockSubmit($form, FormStateInterface $form_state)
    {
        $this->configuration['textValue'] = $form_state->getValue('textValue');

    }

    public function defaultConfiguration()
    {
        $default_config = \Drupal::config('js_custom_header.settings');

        return array(
            'textValue' => $default_config->get('js_custom_header.textValue'),

        );
    }
}