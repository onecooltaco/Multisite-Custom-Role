=== Multisite Custom Role ===
Contributors: onecooltaco
Tags: multisite, roles, capabilities, administration
Requires at least: 4.8
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Grant trusted site administrators selected network, plugin, and theme capabilities on WordPress Multisite.

== Description ==

Multisite Custom Role adds selected network, plugin, and theme-management capabilities to the Administrator role on every site in a WordPress Multisite network.

**Security warning:** This plugin deliberately permits site administrators to perform operations that WordPress normally reserves for super administrators. Install it only on networks where every site administrator is trusted to manage executable plugin and theme code.

On network activation, the plugin updates all existing sites. It also provisions the role when new sites are created.

The following capabilities are added:

* `manage_network`
* `manage_network_themes`
* `manage_network_plugins`
* `edit_themes`
* `install_themes`
* `update_themes`
* `delete_themes`
* `edit_plugins`
* `install_plugins`
* `update_plugins`
* `delete_plugins`

The plugin respects `DISALLOW_UNFILTERED_HTML`, `DISALLOW_FILE_EDIT`, and the file-modification policy enforced by `wp_is_file_mod_allowed()`.

== Installation ==

1. Back up the network database and test on a staging network.
2. Upload the plugin directory to `/wp-content/plugins/`.
3. Network-activate Multisite Custom Role from Network Admin.
4. Verify the permissions with a non-super-admin test account.

This plugin must be network-activated. Site-level activation does not provision the role capabilities.

== Frequently Asked Questions ==

= Is this safe for networks with untrusted site administrators? =

No. Administrators who can install or edit plugins and themes may be able to execute arbitrary PHP code. Use this plugin only when all site administrators are trusted accordingly.

= Does deactivation restore the original role? =

No. The added capabilities remain stored on each site's Administrator role. Remove them from every site before permanently deleting the plugin.

= Is there a settings screen? =

No. The capability set is defined in the plugin code.

== Changelog ==

= 1.0.0 =

* Initial release.
