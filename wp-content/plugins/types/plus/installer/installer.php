<?php 
<<<<<<< HEAD:wp-content/plugins/types/plus/installer/installer.php
define('WP_INSTALLER_VERSION', '1.5.1.1');
=======
define('WP_INSTALLER_VERSION', '1.5.1');
>>>>>>> 0ac586bb2dd6d5e231189d512c4652573374114e:wp-content/plugins/types/plus/installer/installer.php
  
include_once dirname(__FILE__) . '/includes/installer.class.php';
include_once dirname(__FILE__) . '/includes/deps-loader.class.php';

function WP_Installer() {
    return WP_Installer::instance();
}


WP_Installer();

include_once dirname(__FILE__) . '/includes/installer-api.php';

// Ext function 
function WP_Installer_Show_Products($args = array()){
    
    WP_Installer()->show_products($args);
    
}

 