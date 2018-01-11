<?php

return [
    'mode'                 => 'UTF-8',
    'format'               => 'A4',
    'default_font_size'    => '12',
    'default_font'         => 'sans-serif',
    'custom_font_path'     => base_path('/resources/fonts/'), // don't forget the trailing slash!
    'direction'            => 'ltr',
    'margin_left'          => 15,
    'margin_right'         => 15,
    'margin_top'           => 20,
    'margin_bottom'        => 20,
    'margin_header'        => 10,
    'margin_footer'        => 10,
    'orientation'          => 'P',
    'title'                => 'Zany Soft - Laravel PDF',
    'author'               => '',
    'watermark'            => 'Zany Soft',
    'show_watermark'       => false,
    'watermark_font'       => 'sans-serif',
    'display_mode'         => 'fullpage',
    'watermark_text_alpha' => 0.1
];