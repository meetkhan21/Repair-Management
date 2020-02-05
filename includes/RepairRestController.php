<?php
require_once plugin_dir_path(__FILE__) . 'extras.php';

class RepairRestController
{
    public function __construct()
    {

        $this->namespace = '/repairmanagement/v1';
        $this->resource_name = 'orders';
    }

    public function RegisterRoutes()
    {
        // Insert
        register_rest_route($this->namespace, '/' . $this->resource_name . '/insert', array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'POST',
                'callback' => array($this, 'InsertRouteCallback'),
            )
        ));

//      ADMIN TOTAL SECTION
        register_rest_route($this->namespace, '/' . $this->resource_name . '/get/total', array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'GET',
                'callback' => array($this, 'GetTotalRouteCallback'),
            )
        ));

//        ADMIN PENDING SECTION
        register_rest_route($this->namespace, '/' . $this->resource_name . '/get/pending', array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'GET',
                'callback' => array($this, 'GetPendingRouteCallback'),
            )
        ));

        //        ADMIN PENDING SECTION
        register_rest_route($this->namespace, '/' . $this->resource_name . '/get/completed', array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'GET',
                'callback' => array($this, 'GetCompletedRouteCallback'),
            )
        ));

        //        ADMIN SINGLE SECTION
        register_rest_route($this->namespace, '/' . $this->resource_name . '/update/single', array(
            // Here we register the readable endpoint for collections.
            array(
                'methods' => 'GET',
                'callback' => array($this, 'UpdateSingleRecordStatus'),
            )
        ));

    }

    public function InsertRouteCallback($req)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'repairmanagement';
        $zipcode = $req['zipcode'];
        $model = $req['model'];
        $color = $req['color'];
        $issue_type = $req['issueType'];
        $issue_description = $req['issueDescription'];
        $address = $req['address'];
        $userId = $req['userId'];

        $date = $req['date'];
        $time = $req['time'];

        $user_name = $req['userName'];
        $user_email = $req['email'];
        $mobile_brand = $req['mobileBrand'];
        $status = $req['status'];


        $datetime = convertHtmlTime($date, $time);


        $data = array('repair_mobile_model' => $model,
            'repair_mobile_color' => $color,
            'repiar_user_address' => $address,
            'repair_mobile_order_created' => $datetime,
            'repair_issue_type' => $issue_type,
            'repair_issue_description' => $issue_description,
            'repair_user_id' => $userId,
            'repair_zipcode' => $zipcode,
            'repair_mobile_brand' => $mobile_brand,
            'repair_status' => $status,
            'repair_user_name' => $user_name,
            'repair_user_email' => $user_email);

//        $format = array('%s', '%d');

        $wpdb->insert($table_name, $data);
        $my_id = $wpdb->insert_id;

        if ($my_id > 0) {
            do_action('admin_notices', array($this, 'MainAdminNotice'));
            wp_mail( $user_email, 'Mobile Repair Appointment', 'Your Appointment is under process. Your current Anointment no# is: '.$my_id.'. Thanks for Approaching.' );
            return rest_ensure_response(array("status" => true, "inserted_id" => "$my_id"));
        } else {
            return rest_ensure_response(array("status" => false, "inserted_id" => "None"));
        }


        //    return rest_ensure_response(array($zipcode,$model,$color,$issue_type,$issue_description,$address,$date,$time));
    }

    public function GetTotalRouteCallback($req)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'repairmanagement';
        $user_id = intval($req["userid"]);

        $user_meta = get_userdata($user_id);
        $user_roles = $user_meta->roles;
        if ($user_meta == false) {
            return rest_ensure_response(array("status" => "Cannot Access"));
        }

        if (!(in_array('administrator', $user_roles, true))) {
            return rest_ensure_response(array("status" => "Your are not allowed to access this route, Black Hat testing is Injurious to HEALTH", "userID" => $user_meta));
        }

// TOTAL SECTION ------------------------------------------------------------------
        if (isset($req["page"])) {
            $page_no = intval($req["page"]);
            $page_no *= 50;
            $page_no_limit = $page_no + 50;

            $sql = "SELECT * FROM $table_name ORDER BY repair_id DESC LIMIT $page_no, $page_no_limit";
            $all = $wpdb->get_results($sql);

            return rest_ensure_response(array("status" => true, "data" => $all));

        }
        //        Get ROws Count
        if (isset($req["count"])) {
            $page_no = intval($req["count"]);

            $sql = "SELECT COUNT(*) FROM $table_name";
            $all = $wpdb->get_results($sql);

            return rest_ensure_response(array("status" => true, "data" => $all));

        }


        $sql = "SELECT * FROM $table_name ORDER BY repair_id DESC";
        $all = $wpdb->get_results($sql);
        return rest_ensure_response(array("status" => true, "data" => $all));


    }

    public function GetPendingRouteCallback($req)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'repairmanagement';

        $user_id = intval($req["userid"]);
        $user_meta = get_userdata($user_id);
        $user_roles = $user_meta->roles;

        if ($user_meta == false) {
            return rest_ensure_response(array("status" => "Cannot Access"));
        }
        if (!(in_array('administrator', $user_roles, true))) {
            return rest_ensure_response(array("status" => "Your are not allowed to access this route, Black Hat testing is Injurious to HEALTH", "userID" => $user_meta));
        }

// TOTAL SECTION ------------------------------------------------------------------
        if (isset($req["page"])) {
            $page_no = intval($req["page"]);
            $page_no *= 50;
            $page_no_limit = $page_no + 50;

            $sql = "SELECT * FROM $table_name WHERE repair_status = 'Pending' ORDER BY repair_id DESC LIMIT $page_no, $page_no_limit";
            $all = $wpdb->get_results($sql);

            return rest_ensure_response(array("status" => true, "data" => $all));

        }
        //        Get ROws Count
        if (isset($req["count"])) {
            $page_no = intval($req["count"]);

            $sql = "SELECT COUNT(*) FROM $table_name WHERE repair_status = 'Pending'";
            $all = $wpdb->get_results($sql);

            return rest_ensure_response(array("status" => true, "data" => $all));

        }

        //        Get All Rows
        $table_name = $wpdb->prefix . 'repairmanagement';

        $sql = "SELECT * FROM $table_name ORDER BY repair_id DESC";
        $all = $wpdb->get_results($sql);
        return rest_ensure_response(array("status" => true, "data" => $all));
    }

    public function GetCompletedRouteCallback($req)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'repairmanagement';

        $user_id = intval($req["userid"]);
        $user_meta = get_userdata($user_id);
        $user_roles = $user_meta->roles;

        if ($user_meta == false) {
            return rest_ensure_response(array("status" => "Cannot Access"));
        }
        if (!(in_array('administrator', $user_roles, true))) {
            return rest_ensure_response(array("status" => "Your are not allowed to access this route, Black Hat testing is Injurious to HEALTH", "userID" => $user_meta));
        }

// TOTAL SECTION ------------------------------------------------------------------
        if (isset($req["page"])) {
            $page_no = intval($req["page"]);
            $page_no *= 50;
            $page_no_limit = $page_no + 50;

            $sql = "SELECT * FROM $table_name WHERE repair_status = 'Completed' ORDER BY repair_id DESC LIMIT $page_no, $page_no_limit";
            $all = $wpdb->get_results($sql);

            return rest_ensure_response(array("status" => true, "data" => $all));

        }
        //        Get ROws Count
        if (isset($req["count"])) {
            $page_no = intval($req["count"]);

            $sql = "SELECT COUNT(*) FROM $table_name WHERE repair_status = 'Completed'";
            $all = $wpdb->get_results($sql);

            return rest_ensure_response(array("status" => true, "data" => $all));

        }

        //        Get All Rows
        $table_name = $wpdb->prefix . 'repairmanagement';

        $sql = "SELECT * FROM $table_name ORDER BY repair_id DESC";
        $all = $wpdb->get_results($sql);
        return rest_ensure_response(array("status" => true, "data" => $all));
    }

    public  function UpdateSingleRecordStatus($req){
        global $wpdb;
        $table_name = $wpdb->prefix . 'repairmanagement';
        $user_id = intval($req["userid"]);

        $user_meta = get_userdata($user_id);
        $user_roles = $user_meta->roles;
        if ($user_meta == false) {
            return rest_ensure_response(array("status" => "Cannot Access"));
        }

        if (!(in_array('administrator', $user_roles, true))) {
            return rest_ensure_response(array("status" => "Your are not allowed to access this route, Black Hat testing is Injurious to HEALTH", "userID" => $user_meta));
        }

        $orderno = intval($req["orderno"]);
        $status = $req["status"];

        $data = array("repair_status"=> $status);
        $where = array("repair_id"=> $orderno);

        $updated = $wpdb->update( $table_name, $data, $where);

        if($updated == false){
            return rest_ensure_response(array("status" => false));
        }
        return rest_ensure_response(array("status" => true));


    }



    public function MainAdminNotice()
    {
        global $pagenow;
        if ($pagenow == 'index.php') {
            $user = wp_get_current_user();
            if (in_array('author', (array)$user->roles)) {
                echo '<div class="notice notice-info is-dismissible">
                        <p>New Order On Repairs</p>
                        </div>';
            }
        }
    }

}


