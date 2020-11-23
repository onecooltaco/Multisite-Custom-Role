<?php

/*
Plugin Name:  Custom Role
Version:  1.0
Description:  Customize WordPress User Roles.
Author:  Jeremy Leggat
Author URI:  https://cronkite.asu.edu
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  custom-role
*/

// this code runs only during plugin activation and never again

/*
This code runs on every site in the network
when the plugin is Network Activated
*/
function add_custom_role($network_wide)
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-custom-user-role.php';
 
    if (is_multisite() && $network_wide) {
        // run the code for all sites in a Multisite network
        foreach (get_sites(['fields' => 'ids']) as $blog_id) {
            switch_to_blog($blog_id);
                Custom_User_Role::activate();
        }
            restore_current_blog();
    }
}
register_activation_hook(__FILE__, 'add_custom_role');

// run the code once again when a new site is created
function add_custom_role_new_site($blog_id)
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-custom-user-role.php';
    // check whether the plugin is active for the network
    if (is_plugin_active_for_network('add-custom-user-role/add-custom-user-role.php')) {
        switch_to_blog($blog_id);
        Custom_User_Role::activate();
        restore_current_blog();
    }
}
add_action('wpmu_new_blog', 'add_custom_role_new_site');