<?php
function wpgd_trigger_github_deploy() {
    $token = get_option('wpgd_github_token');
    $repo = get_option('wpgd_repo_name');

    $url = "https://api.github.com/repos/$repo/dispatches";

    $response = wp_remote_post($url, [
        'headers' => [
            'Authorization' => "token $token",
            'User-Agent' => 'WP-GitHub-Deployer',
            'Accept' => 'application/vnd.github.v3+json'
        ],
        'body' => json_encode(['event_type' => 'wp_deploy_trigger'])
    ]);

    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    } else {
        return 'Triggered GitHub Deploy.';
    }
}

add_action('admin_post_wpgd_deploy_now', function () {
    echo wpgd_trigger_github_deploy();
    wp_redirect(admin_url('admin.php?page=wpgd&status=success'));
    exit;
});
