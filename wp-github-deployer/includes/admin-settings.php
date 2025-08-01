<?php
function wpgd_admin_menu() {
    add_menu_page('GitHub Deployer', 'GitHub Deployer', 'manage_options', 'wpgd', 'wpgd_settings_page');
}
add_action('admin_menu', 'wpgd_admin_menu');

function wpgd_settings_page() {
    ?>
    <div class="wrap">
        <h2>GitHub Deployment Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('wpgd_options');
            do_settings_sections('wpgd');
            submit_button();
            ?>
        </form>
        <p>
            <a href="<?php echo admin_url('admin-post.php?action=wpgd_deploy_now'); ?>" class="button button-primary">
                Deploy Now to GitHub
            </a>
        </p>
    </div>
    <?php
}

function wpgd_register_settings() {
    register_setting('wpgd_options', 'wpgd_github_token');
    register_setting('wpgd_options', 'wpgd_repo_name');

    add_settings_section('wpgd_section', 'GitHub Config', null, 'wpgd');

    add_settings_field('wpgd_github_token', 'GitHub Token', function () {
        $value = esc_attr(get_option('wpgd_github_token'));
        echo "<input type='text' name='wpgd_github_token' value='$value' class='regular-text'>";
    }, 'wpgd', 'wpgd_section');

    add_settings_field('wpgd_repo_name', 'Repo Name (e.g. user/repo)', function () {
        $value = esc_attr(get_option('wpgd_repo_name'));
        echo "<input type='text' name='wpgd_repo_name' value='$value' class='regular-text'>";
    }, 'wpgd', 'wpgd_section');
}
add_action('admin_init', 'wpgd_register_settings');
