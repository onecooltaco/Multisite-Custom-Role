# Multisite Custom Role

> **Archived project:** This plugin is no longer maintained and is retained for historical reference. Do not use it for new installations. If it is already installed, review the [deactivation and removal guidance](#deactivation-and-removal) before deleting it because its role changes persist after deactivation.

A small WordPress Multisite plugin that gives site administrators selected network, plugin, and theme-management capabilities across a network.

> **Security warning:** This plugin deliberately expands the authority of the Administrator role beyond WordPress Multisite defaults. It is intended only for networks where every site administrator is trusted to install, edit, update, and delete executable code.

## What it does

When network-activated, the plugin visits every existing site and adds the following capabilities to its Administrator role:

| Area | Capabilities |
| --- | --- |
| Network | `manage_network`, `manage_network_themes`, `manage_network_plugins` |
| Themes | `edit_themes`, `install_themes`, `update_themes`, `delete_themes` |
| Plugins | `edit_plugins`, `install_plugins`, `update_plugins`, `delete_plugins` |

It also applies those capabilities when a new site is created and filters WordPress capability mapping so eligible administrators can use them. WordPress normally restricts several of these operations to super administrators on Multisite.

## Requirements

- WordPress Multisite
- Network activation
- WordPress 4.8 or later (`wp_is_file_mod_allowed()` was introduced in WordPress 4.8)

This repository does not currently include an automated compatibility matrix or test suite. Test the plugin on a staging network before using it in production.

## Installation

1. Back up the network database and test the plugin in a staging environment.
2. Copy the repository to `wp-content/plugins/Multisite-Custom-Role`, or install a ZIP of the repository from Network Admin.
3. Open **Network Admin → Plugins**.
4. Network-activate **Multisite Custom Role**.
5. Confirm the intended permissions with a non-super-admin test account on a representative site.

The plugin is network-only. Activating it for an individual site will not provision the role capabilities.

## WordPress safeguards

The runtime capability filter continues to honor these WordPress controls:

- `DISALLOW_UNFILTERED_HTML`
- `DISALLOW_FILE_EDIT`
- `DISALLOW_FILE_MODS`, through `wp_is_file_mod_allowed()`

These controls are an important additional defense, but they do not make untrusted administrators safe. Installing or editing a plugin or theme can permit arbitrary PHP execution with the privileges of the WordPress application.

## Deactivation and removal

Deactivation stops the runtime capability filter, but it does **not** remove the capabilities previously stored on each site's Administrator role.

Before deleting the plugin permanently:

1. Back up the database.
2. Remove each capability listed above from the Administrator role on every site where it was added.
3. Verify the resulting permissions with a non-super-admin account.
4. Deactivate and delete the plugin.

There is currently no settings screen, uninstall routine, or automated rollback command.

## Known compatibility notes

- New-site provisioning uses `wpmu_new_blog`, which [WordPress deprecated in version 5.1](https://developer.wordpress.org/reference/hooks/wpmu_new_blog/) in favor of `wp_initialize_site`.
- The new-site callback calls `is_plugin_active_for_network()`. [WordPress documents that its defining file must be loaded explicitly outside the administration area](https://developer.wordpress.org/reference/functions/is_plugin_active_for_network/).
- The plugin intentionally overrides several Multisite restrictions implemented by [`map_meta_cap()`](https://developer.wordpress.org/reference/functions/map_meta_cap/). Review those mappings when upgrading WordPress.

These items are documented for maintainers and should be addressed and tested before declaring compatibility with future WordPress releases.

## Project status

This project is archived and no longer maintained. It receives no compatibility or security updates and has no bundled automated tests. The source remains available for historical reference; forks should independently review its security model and compatibility with current WordPress releases.

## License

Licensed under the [GNU General Public License v2.0](LICENSE).
