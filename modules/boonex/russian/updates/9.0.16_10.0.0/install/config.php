<?php
/**
 * Copyright (c) UNA, Inc - https://una.io
 * MIT License - https://opensource.org/licenses/MIT
 */

$aConfig = array(
    /**
     * Main Section.
     */
    'title' => 'Russian',
    'version_from' => '9.0.16',
    'version_to' => '10.0.0',
    'vendor' => 'BoonEx',

    'compatible_with' => array(
        '9.0.x',
        '10.0.x'
    ),

    /**
     * 'home_dir' and 'home_uri' - should be unique. Don't use spaces in 'home_uri' and the other special chars.
     */
    'home_dir' => 'boonex/russian/updates/update_9.0.16_10.0.0/',
    'home_uri' => 'ru_update_9016_1000',

    'module_dir' => 'boonex/russian/',
    'module_uri' => 'ru',

    'db_prefix' => 'bx_rsn_',
    'class_prefix' => 'BxRsn',

    /**
     * Installation/Uninstallation Section.
     */
    'install' => array(
        'execute_sql' => 0,
        'update_files' => 1,
        'update_languages' => 1,
        'restore_languages' => 0,
        'clear_db_cache' => 0,
    ),

    /**
     * Category for language keys.
     */
    'language_category' => array(
        array('name' => 'Accounts Manager', 'path' => 'bx_accounts/'),
        array('name' => 'Albums', 'path' => 'bx_albums/'),
        array('name' => 'Antispam', 'path' => 'bx_antispam/'),
        array('name' => 'Channels', 'path' => 'bx_channels/'),
        array('name' => 'Contact', 'path' => 'bx_contact/'),
        array('name' => 'Conversations', 'path' => 'bx_convos/'),
        array('name' => 'Decorous', 'path' => 'bx_decorous/'),
        array('name' => 'Developer', 'path' => 'bx_developer/'),
        array('name' => 'Dolphin connect', 'path' => 'bx_dolcon/'),
        array('name' => 'Events', 'path' => 'bx_events/'),
        array('name' => 'Facebook connect', 'path' => 'bx_facebook/'),
        array('name' => 'Files', 'path' => 'bx_files/'),
        array('name' => 'Discussions', 'path' => 'bx_forum/'),
        array('name' => 'Froala', 'path' => 'bx_froala/'),
        array('name' => 'Glossary', 'path' => 'bx_glossary/'),
        array('name' => 'Google connect', 'path' => 'bx_googlecon/'),
        array('name' => 'Groups', 'path' => 'bx_groups/'),
        array('name' => 'Invitations', 'path' => 'bx_invites/'),
        array('name' => 'LinkedIn connect', 'path' => 'bx_linkedin/'),
        array('name' => 'Market', 'path' => 'bx_market/'),
        array('name' => 'Notifications', 'path' => 'bx_notifications/'),
        array('name' => 'Organizations', 'path' => 'bx_organizations/'),
        array('name' => 'Payment', 'path' => 'bx_payment/'),
        array('name' => 'Persons', 'path' => 'bx_persons/'),
        array('name' => 'Photos', 'path' => 'bx_photos/'),
        array('name' => 'Plyr', 'path' => 'bx_plyr/'),
        array('name' => 'Polls', 'path' => 'bx_polls/'),
        array('name' => 'Posts', 'path' => 'bx_posts/'),
        array('name' => 'Protean', 'path' => 'bx_protean/'),
        array('name' => 'Quote of the Day', 'path' => 'bx_quoteofday/'),
        array('name' => 'Shopify', 'path' => 'bx_shopify/'),
        array('name' => 'SMTP Mailer', 'path' => 'bx_smtp/'),
        array('name' => 'Snipcart', 'path' => 'bx_snipcart/'),
        array('name' => 'Spaces', 'path' => 'bx_spaces/'),
        array('name' => 'Timeline', 'path' => 'bx_timeline/'),
        array('name' => 'Twitter connect', 'path' => 'bx_twitter/'),
        array('name' => 'UNA connect', 'path' => 'bx_unacon/'),
        array('name' => 'Videos', 'path' => 'bx_videos/'),
        array('name' => 'System', 'path' => 'system/'),
    ),

    /**
     * Files Section
     */
    'delete_files' => array(),
);
