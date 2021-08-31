<?php

if (!function_exists('sitesauce_deployments_get_options')) {
    /**
     * Return the plugin settings/options
     *
     * @return array
     */
    function sitesauce_deployments_get_options()
    {
        return get_option(SITESAUCE_DEPLOYMENTS_OPTIONS_KEY);
    }
}


if (!function_exists('sitesauce_deployments_get_build_hook')) {
    /**
     * Return the webhook url
     *
     * @return string|null
     */
    function sitesauce_deployments_get_build_hook()
    {
        $options = sitesauce_deployments_get_options();
        return isset($options['build_hook']) ? $options['build_hook'] : null;
    }
}

if (!function_exists('sitesauce_deployments_fire_webhook')) {
    /**
     * Fire a request to the webhook.
     *
     * @return void
     */
    function sitesauce_deployments_fire_webhook()
    {
        \Sitesauce\Wordpress\WebhookTrigger::fireWebhook();
    }
}

if (!function_exists('sitesauce_deployments_force_fire_webhook')) {
    /**
     * Fire a request to the webhook immediately.
     *
     * @return void
     */
    function sitesauce_deployments_force_fire_webhook()
    {
        \Sitesauce\Wordpress\WebhookTrigger::fireWebhook();
    }
}

if (!function_exists('sitesauce_deployments_fire_webhook_save_post')) {
    /**
     * Fire a request to the webhook when a post is saved.
     *
     * @param int $id
     * @return void
     */
    function sitesauce_deployments_fire_webhook_save_post($id)
    {
        \Sitesauce\Wordpress\WebhookTrigger::triggerSavePost($id);
    }
    add_action('save_post', 'sitesauce_deployments_fire_webhook_save_post');
}

if (!function_exists('sitesauce_deployments_fire_webhook_trashed_post')) {
    /**
     * Fire a request to the webhook when a post is deleted.
     *
     * @return void
     */
    function sitesauce_deployments_fire_webhook_trashed_post()
    {
        \Sitesauce\Wordpress\WebhookTrigger::triggerTrashedPost();
    }
    add_action('trashed_post', 'sitesauce_deployments_fire_webhook_trashed_post');
}

if (!function_exists('sitesauce_deployments_fire_webhook_option_added_updated')) {
    /**
     * Fire a request to the webhook when an option is updated.
     *
     * @return void
     */
    function sitesauce_deployments_fire_webhook_option_added_updated()
    {
        \Sitesauce\Wordpress\WebhookTrigger::triggerOptionAddedUpdated();
    }
    add_action('updated_option', 'sitesauce_deployments_fire_webhook_option_added_updated');
    add_action('added_option', 'sitesauce_deployments_fire_webhook_option_added_updated');
}

if (!function_exists('sitesauce_deployments_fire_webhook_acf_save_post')) {
    /**
     * Fire a request to the webhook when an acf page/post is updated.
     * This is useful for capturing changes to acf options pages, etc.
     * 
     * @return void
     */
    function sitesauce_deployments_fire_webhook_acf_save_post()
    {
        \Sitesauce\Wordpress\WebhookTrigger::triggerOptionAcfSavePost($post_id);
    }
    add_action('acf/save_post', 'sitesauce_deployments_fire_webhook_acf_save_post');
}
