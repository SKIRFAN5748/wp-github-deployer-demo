<?php
/**
 * Plugin Name: WP GitHub Deployer
 * Description: Deploy WordPress content or theme to GitHub Pages or Netlify using GitHub Actions.
 * Version: 0.1
 * Author: Sk Irfan
 */

defined('ABSPATH') || exit;

require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/github-api.php';

register_activation_hook(__FILE__, function () {
    add_option('wpgd_github_token', '');
    add_option('wpgd_repo_name', '');
});
