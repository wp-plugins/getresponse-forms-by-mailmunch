<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

delete_option("gr_mm_data");
delete_option("gr_mm_user_email");
delete_option("gr_mm_user_password");
delete_option("gr_mm_guest_user");
?>
