<?php
//https://github.com/joshcam/PHP-MySQLi-Database-Class
require_once 'MysqliDb.php';

class ajax_server {

    function __construct() {
        $this->db = new MysqliDb( "localhost", "root", "", "iaeste_neu" );
        $server_address = $_SERVER['REMOTE_ADDR'];
        if ( isset( $server_address ) ) {
            if ( $server_address == "::1" ) {
                $this->db = new MysqliDb( "localhost", "root", "", "iaeste_neu" );
                return;
            }
            if ( $server_address == "127.0.0.1" ) {
                $this->db = new MysqliDb( "localhost", "root", "", "iaeste_neu" );
                return;
            }
            // $this->host = "db.planet-school.de";
            // $this->user = "m8282-2";
            // $this->pass = "aexohjee";
            // $this->db = "m8282-2";

                $this->db = new MysqliDb( "iaeste-freiberg.de.mysql", "iaeste_freiberg", "23Safreiiy", "iaeste_freiberg" );
            return;
        }
                $this->db = new MysqliDb( "localhost", "root", "", "iaeste_neu" );
    }
    public function sendMail() {
        $to      = 'florenz.erstling@iaeste-freiberg.de';
        $subject = 'the subject';
        $message = 'Moin was geht';
        $headers = 'From: bewerbung@iaeste-freiberg.de' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }

    public function saveApplicationPersoenlich( $data ) {
        $data = json_decode( $data['data'] );
        $old_data = (array)$data;
        $data = array (
            'vorname' => $old_data['vorname'],
            'nachname' => $old_data['nachname'],
            'geburtstag' => $old_data['geburtstag'],
            'email' => $old_data['email'],
            'mobil' => $old_data['mobil'],
        );
        $id = $this->db->insert ( 'iaeste_apply_persoenlicheDaten', $data );
        if ( $id ) {
            $data = array (
                'id' => $id,
                'hochschule' => $old_data['hochschule'],
                'studiengang' => $old_data['studiengang'],
                'vertiefungsrichtung' => $old_data['vertiefungsrichtung'],
                'semester' => $old_data['semester'],
            );
            $id = $this->db->insert ( 'iaeste_apply_studium', $data );
        }
        if ( $id ) {
            $data = array (
                'id' => $id,
                'englisch' => $old_data['englisch'],
                'spanisch' => $old_data['spanisch'],
                'franzoesisch' => $old_data['franzoesisch'],
                'andereSprachen' => $old_data['andereSprachen'],
                'programmiersprachen' => $old_data['programmiersprachen'],
                'cad' => $old_data['cad'],
                'sonstiges' => $old_data['sonstiges'],
            );
            $id = $this->db->insert ( 'iaeste_apply_sprachen', $data );
        }
        if ( $id ) {
            $data = array (
                'id' => $id,
                'landEgal' => $old_data['landEgal'],
                'landEuropa' => $old_data['landEuropa'],
                'landAmerika' => $old_data['landAmerika'],
                'landAsien' => $old_data['landAsien'],
                'landAfrika' => $old_data['landAfrika'],
                'landWunsch' => $old_data['landWunsch'],
            );
            $id = $this->db->insert ( 'iaeste_apply_laenderWuensche', $data );
        }
        if ( $id ) {
            $data = array (
                'id' => $id,
                'motivation' => $old_data['motivation'],
                'anmerkung' => $old_data['anmerkung'],
            );
            $id = $this->db->insert ( 'iaeste_apply_sonstiges', $data );
        }
        if ( $id ) {

            echo '{"status":"ok","id":"'.$id.'"}';
            $this->sendMail();
        }
        else
            echo '{"status":"'.$this->db->getLastError().'"}';
    }
}


$ajax_functions = new ajax_server();
if ( isset( $_REQUEST["operation"] ) && strpos( $_REQUEST["operation"], "_" ) !== 0 && method_exists( $ajax_functions, $_REQUEST["operation"] ) ) {

    print_r( $ajax_functions->{$_REQUEST["operation"]}( $_REQUEST ) );
    die();
}
