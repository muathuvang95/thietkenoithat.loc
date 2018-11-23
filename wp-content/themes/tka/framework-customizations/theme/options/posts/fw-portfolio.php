<?php if (!defined( 'FW' )) die('Forbidden');

$options = array(
    'portfolio-excerpt' => array(
        'type' => 'box',
        'title' => 'Tóm tắt công trình',
        'options' => array(
            '_excerpt' => array(
                'label' => '',
                'type'  => 'wp-editor',
                'size' => 'large',
            ),
        ),
    ),
);