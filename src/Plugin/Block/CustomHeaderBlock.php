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

        if (!empty($config['HeaderText'])) {
            $header_text = $config['HeaderText'];
        } else {
            $header_text = $this->t('');
        }

        //Render template with variables
        return array(
            '#theme' => 'custom-header-block',
            '#HeaderText' => $header_text,


        );
    }
}