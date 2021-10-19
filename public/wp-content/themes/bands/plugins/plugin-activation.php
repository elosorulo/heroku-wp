<?php
require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'bands_register_required_plugins' );
function bands_register_required_plugins() {
$plugins = array(
array(
'name'      => 'Audio Album',
'slug'      => 'audio-album',
'required'  => false,
),
array(
'name'      => 'Simple Podcasting',
'slug'      => 'simple-podcasting',
'required'  => false,
),
);
$config = array(
'id'           => 'bands',
'default_path' => '',
'menu'         => 'install-plugins',
'has_notices'  => true,
'dismissable'  => true,
'dismiss_msg'  => '',
'is_automatic' => true,
'message'      => '',
);
tgmpa( $plugins, $config );
}