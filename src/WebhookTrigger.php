<?php

namespace Sitesauce\Wordpress;

class WebhookTrigger
{
    /**
     * Use this to track whether we have already triggered the webhook
     * This stops the webhook being triggered twice
    */ 
    static $triggered = false;

    /**
     * When a post is saved or updated, fire this
     *
     * @param int $id
     * @return void
     */
    public static function triggerSavePost($post_id)
    {
        if (get_post_status($post_id) !== 'publish') {
            return;
        }

        self::fireWebhook();
    }

    /**
     * When an options page is added, fire this
     *
     * @return void
     */
    public static function triggerOptionAdded($option, $value)
    {
        $options = apply_filters( 'sitesauce_filter_trigger_options', array() );

        if(in_array($option, $options)) {
            self::fireWebhook();
        }
    }

    /**
     * When an options page is updated, fire this
     *
     * @return void
     */
    public static function triggerOptionUpdated($option, $old_value, $value)
    {
        $options = apply_filters( 'sitesauce_filter_trigger_options', array() );

        if(in_array($option, $options)) {
            self::fireWebhook();
        }
    }

    /**
     * Fires on the ACF Save Post hook
     * Useful for when ACF is used, and used on Options pages
     *
     * @return void
     */
    public static function triggerOptionAcfSavePost($post_id)
    {
        self::fireWebhook();
    }

    /**
     * Fire a request to the webhook when a term has been created.
     *
     * @return void
     */
    public static function triggerTrashedPost()
    {
        self::fireWebhook();
    }

    /**
     * Fire off a request to the webhook
     *
     * @return WP_Error|array
     */
    public static function fireWebhook()
    {
        if (filter_var($hook = sitesauce_deployments_get_build_hook(), FILTER_VALIDATE_URL) === false) {
            return;
        }

        if(self::$triggered) {
            return;
        }

        self::$triggered = true;

        return file_get_contents($hook);
    }
}
