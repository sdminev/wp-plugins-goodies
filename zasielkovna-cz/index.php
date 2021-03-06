<?php
/*
Plugin Name: Zasielkovna CZ Offices
Plugin URI: http://sdminev.com
Description: Get all CZ zasielkovna offices
Version: 1.03
Author: Stefan Minev
Author URI: http://sdminev.com
*/

//if ( !defined('BASE_DIR_ZASIELKOVNA') )
  define('BASE_DIR_ZASIELKOVNA', dirname(__FILE__));

//if ( !defined('OFFICE_TABLE_ZASIELKOVNA_CZ') )
  define('OFFICE_TABLE_ZASIELKOVNA_CZ', 'ZASIELKOVNA_offices');


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

//	Create tables
function create_table_ZASIELKOVNA_CZ() {
  global $wpdb;
	$office_table = OFFICE_TABLE_ZASIELKOVNA_CZ;


	$sql = "CREATE TABLE IF NOT EXISTS `{$office_table}` (
      `office_code` varchar(20) NOT NULL,
      `name` varchar(255) NOT NULL,
      `country_code` varchar(20) NOT NULL,
      `city_name` varchar(255) NOT NULL,
      `post_code` varchar(20) NOT NULL,
      `address` varchar(255) NOT NULL,
      `ZASIELKOVNA_id` int(11) NOT NULL,
	`updated_at` datetime NOT NULL,
	    PRIMARY KEY (office_code)
	  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='All ZASIELKOVNA Offices CZ'
	  ";

  $create_table = $wpdb->query($sql);

  if ($create_table) {
    insertOfficesZASIELKOVNA();
  }
}
register_activation_hook( __FILE__, 'create_table_ZASIELKOVNA_CZ' );


function getFHBtoken(){
$app_id = '902428776bb3970ee0c6fa27e837130f';
$secret = 'IfS6Eo8Y3DIlDi2dc3de28e1uqd8c96d7y0k2cvk';
$loginEndpoint = 'https://api.fhb.sk/v3/login';

$url = 'https://api.fhb.sk/v3/login';
$data = array("app_id" => $app_id,"secret" => $secret );

$postdata = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
$result2 = json_decode($result, true);
curl_close($ch);
//print_r ($result);


    return $result2['token'];

}


function getOfficesZASIELKOVNA() {
  // https://ee.ZASIELKOVNA.com/
  $token = base64_encode(getFHBtoken());
  $tokens = "X-Authentication-Simple: ".$token;
  //$username = 'n.slavov@wowtea.eu'; // your username
  //$password = 'WOWZASIELKOVNA19'; // your password
$headers= array(
  $tokens,
  'Content-Type: application/json'
  );
$headers2 = json_encode($headers);
  // $endPoint = 'http://demo.ZASIELKOVNA.com/e-ZASIELKOVNA/xml_service_tool.php'; // demo url
  $endPoint = 'https://api.fhb.sk/v3/delivery-point/zasielkovna_cz'; // live url
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $endPoint);
  //curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 0);
  //curl_setopt($ch, CURLOPT_POSTFIELDS, array('xml' => $request->asXML()));
  $response = curl_exec($ch);
  curl_close($ch);


    return $response;

}

function insertOfficesZASIELKOVNA() {
  global $wpdb;
  $office_table = OFFICE_TABLE_ZASIELKOVNA_CZ;
  $all_offices = json_decode(getOfficesZASIELKOVNA());

  if ($all_offices || 1) {
    $date = date('Y-m-d H:i:s', strtotime('NOW'));
    foreach ($all_offices as $office) {
    $office->name = str_replace("'", "''", $office->name);
      $sql = "INSERT INTO {$office_table}
              (office_code, name, country_code, city_name, post_code, address, ZASIELKOVNA_id, updated_at)
              VALUES ('{$office->external_code}',
                      '{$office->name}',
                      '{$office->country}',
                      '{$office->city}',
                      '{$office->zip}',
                      '{$office->street}',
                      '{$office->id}',
                      '{$date}'
                    )
              ON DUPLICATE KEY
              UPDATE name = '{$office->name}',
                    country_code = '{$office->country}',
                    city_name = '{$office->city}',
                    post_code = '{$office->zip}',
                    address = '{$office->street}',
                    ZASIELKOVNA_id = '{$office->id}',
                    updated_at = '{$date}'
            ";

      $wpdb->query($sql);
    }

    $result = 'Update Offices Zasielkovna => '. date('Y-m-d H:i:s');
    write_logs_ZASIELKOVNA($result);
  }
}

add_action( 'admin_init', 'weekly_update_ZASIELKOVNA_offices' );
function weekly_update_ZASIELKOVNA_offices() {
  // $current_day = date('N', time());
  // if ($current_day == 3) {
    $execute_update_office = get_option( 'update_ZASIELKOVNA_office' );
    if (!$execute_update_office || time() > $execute_update_office) {
      insertOfficesZASIELKOVNA();
      $result = 'update_ZASIELKOVNA_office => '. date('Y-m-d H:i:s', time()+(60*60*2));
      write_logs_ZASIELKOVNA($result);
      update_option( 'update_ZASIELKOVNA_office', (time()+3600*24) );
    }
  // }

 if ( !wp_next_scheduled( 'ZASIELKOVNA_cron_get_offices' ) ) {
   wp_schedule_event( strtotime('09:00:00'), 'daily', 'ZASIELKOVNA_cron_get_offices' );
 }
 add_action( 'ZASIELKOVNA_cron_get_offices', 'insertOfficesZASIELKOVNA' );


}



// get offices
function get_ZASIELKOVNA_offices( $atts ) {
insertOfficesZASIELKOVNA();
  global $wpdb;
  $office_table = OFFICE_TABLE_ZASIELKOVNA_CZ;
  $allow_countries = array(
                      'BEL', 'BGR', 'CYP', 'CZE', 'GBR', 'GRC','HUN', 'ROU', 'SVN', 'CZK', 'CZ'
                  );
	
  $transient_prefix = 'all_ZASIELKOVNA_offices_wowtea_CZ';
  $query = 'SELECT * FROM '.$office_table.' WHERE address != "" AND country_code = "cz" AND DATE(updated_at) > DATE_SUB(CURDATE(), INTERVAL 1 MINUTE) ORDER BY city_name';

  if ( isset($atts['country']) && in_array($atts['country'], $allow_countries) ) {
    $transient_prefix = $atts['country'].'_ZASIELKOVNA_offices_CZ';
    $query = 'SELECT * FROM '.$office_table.' WHERE address != "" AND DATE(updated_at) > DATE_SUB(CURDATE(), INTERVAL 1 MINUTE) ORDER BY city_name';
  }

  $results = get_transient( $transient_prefix );
  if ( $results === false || count($results) == 0 ) {
    $results = $wpdb->get_results( $query, 'ARRAY_A' );
    set_transient( $transient_prefix, $results, 10 );
  }

  $html = '<select id="ZASIELKOVNA_offices" name="ZASIELKOVNA_offices"><option data-test="test" value="">Vybrat Zasilkovna m??sto</option>';
  ksort($results);
  foreach ($results as $key => $val) {
  //$jsonName = str_replace("\u0022","\\\\\"",json_encode( $val['name'],JSON_HEX_QUOT)); 
  
  $jsonName = htmlspecialchars( $val['name'], ENT_QUOTES, 'UTF-8');
$jsonName = str_replace("\u0022", " ", $jsonName );
$jsonName = str_replace("\u0027", " ",  $jsonName );


    //if (strpos($val['office_code'], '@') === FALSE) {
      $html .= '<option value="'.$val['office_code'].'"data-data=\'{"postcode":"'.$val['post_code'].'", "city":"'.$val['city_name'].'" , "address":"'.$val['address'].'"}\'>'.$val['city_name'].', '.$val['address'].', '.$val['post_code'].', N??zev objektu: '.$val['name']. '</option><span style="display:none;" class="helper-city" value="'.$val['office_code'].'">'.$val['city_name'].'</span>';
    //}
  }
  $html .= '</select>';
  
  $testdata = json_decode(getOfficesZASIELKOVNA());
  //foreach($testdata as $testdata1){print_r($testdata1->id . ' ');}
  $html .= '<br />';
  return $html;
}

add_shortcode('ZASIELKOVNAOffices', 'get_ZASIELKOVNA_offices');

function write_logs_ZASIELKOVNA($data) {
  $logs_file = fopen(BASE_DIR_ZASIELKOVNA . DIRECTORY_SEPARATOR ."logs.txt", "a+");
  fwrite($logs_file, print_r($data, true)."\n"."this is test" . "\n");
  fclose($logs_file);
}
 