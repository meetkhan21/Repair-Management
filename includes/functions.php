<?php

if (!function_exists('repairActivation')) {
    function repairActivation()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'repairmanagement';
        $charset_collate = $wpdb->get_charset_collate();

        if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            $sql = "CREATE TABLE $table_name (
                        repair_id BIGINT NOT NULL AUTO_INCREMENT,
                        repair_mobile_model TEXT NULL,
                        repair_zipcode TEXT NULL,
                        repair_mobile_color TEXT NULL,
                        repiar_user_address TEXT NULL,
                        repair_mobile_order_created DATETIME NULL,
                        repair_user_id BIGINT NULL,
                        repair_issue_type TEXT NULL,
                        repair_issue_description TEXT NULL,
                        repair_mobile_brand TEXT NULL,
	                    repair_status TEXT NULL,
	                    repair_user_name TEXT NULL,
	                    repair_user_email TEXT NULL, 
                        PRIMARY KEY (`repair_id`)
                    ) $charset_collate;";

            require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
}
