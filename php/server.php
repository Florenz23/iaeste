<?php
//https://github.com/joshcam/PHP-MySQLi-Database-Class
require_once 'MysqliDb.php';

class ajax_server {

    function __construct() {
        $this->db = new MysqliDb( "localhost", "root", "", "iaeste_neu" );
    }

    public function saveApplicationPersoenlich( $data ) {
        $data = json_decode( $data['data'] );
        $data = (array)$data;
        $data = Array (
            'vorname' => $data['vorname'],
            'nachname' => $data['nachname'],
            'geburtstag' => $data['geburtstag'],
            'email' => $data['email'],
            'mobil' => $data['mobil'],
        );
        $id = $this->db->insert ( 'iaeste_apply_persoenlicheDaten', $data );
        if ( $id )
            echo '{"status":"ok","id":"'.$id.'"}';
        else
            echo '{"status":"'.$this->db->getLastError().'"}';
    }
}


$ajax_functions = new ajax_server();
if ( isset( $_REQUEST["operation"] ) && strpos( $_REQUEST["operation"], "_" ) !== 0 && method_exists( $ajax_functions, $_REQUEST["operation"] ) ) {

    print_r( $ajax_functions->{$_REQUEST["operation"]}( $_REQUEST ) );
    die();
}
