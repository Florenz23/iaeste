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


    public function sendMail( $data_array ) {

        $message .= "</table>";
        $message = '<html>
                    <head>
                        <title>Iaese Bewerbung</title>
                    </head>

                    <body>
                    <h1>Hallo '.$data_array['vorname'].', vielen Dank, dass du dich für Iaste engschieden hast, du wirst es nicht bereuen!</h1>

                    <p>Hier noch einmal ein im Detail alle Informationen, die du in deiner Bewerbung angegeben hast.</p>';

        $message .=  "<table border = '1'>";
            $message .= "<tr>";
            $message .= "   <td>Vorname</td>";
            $message .= "   <td>" . $data_array['vorname'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Nachname</td>";
            $message .= "   <td>" . $data_array['nachname'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Geburtstag</td>";
            $message .= "   <td>" . $data_array['geburtstag'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Email</td>";
            $message .= "   <td>" . $data_array['email'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Mobil</td>";
            $message .= "   <td>" . $data_array['mobil'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Studiengang</td>";
            $message .= "   <td>" . $data_array['studiengang'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Vertiefungsrichtung</td>";
            $message .= "   <td>" . $data_array['vertiefungsrichtung'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Semester</td>";
            $message .= "   <td>" . $data_array['semester'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Studiengang</td>";
            $message .= "   <td>" . $data_array['studiengang'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Vertiefungsrichtung</td>";
            $message .= "   <td>" . $data_array['vertiefungsrichtung'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Semester</td>";
            $message .= "   <td>" . $data_array['semester'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Englisch</td>";
            $message .= "   <td>" . $data_array['englisch'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Spanisch</td>";
            $message .= "   <td>" . $data_array['spanisch'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>franzoesisch</td>";
            $message .= "   <td>" . $data_array['franzoesisch'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Spanisch</td>";
            $message .= "   <td>" . $data_array['Spanisch'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>andereSprachen</td>";
            $message .= "   <td>" . $data_array['andereSprachen'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>programmiersprachen</td>";
            $message .= "   <td>" . $data_array['programmiersprachen'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>sonstiges</td>";
            $message .= "   <td>" . $data_array['sonstiges'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>praktischeErfahrung</td>";
            $message .= "   <td>" . $data_array['praktischeErfahrung'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>praktikumAbsolviert</td>";
            $message .= "   <td>" . $data_array['praktikumAbsolviert'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>gewuenschteDauer</td>";
            $message .= "   <td>" . $data_array['gewuenschteDauer'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>gewuenschterZeitraum</td>";
            $message .= "   <td>" . $data_array['gewuenschterZeitraum'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>interessenPraktikum</td>";
            $message .= "   <td>" . $data_array['interessenPraktikum'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>landEgal</td>";
            $message .= "   <td>" . $data_array['landEgal'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>landEuropa</td>";
            $message .= "   <td>" . $data_array['landEuropa'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>landAmerika</td>";
            $message .= "   <td>" . $data_array['landAmerika'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>landAsien</td>";
            $message .= "   <td>" . $data_array['landAsien'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>landAfrika</td>";
            $message .= "   <td>" . $data_array['landAfrika'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>landWunsch</td>";
            $message .= "   <td>" . $data_array['landWunsch'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Länder, in die du nicht willst. </td>";
            $message .= "   <td>" . $data_array['landNein'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Deine Motivation</td>";
            $message .= "   <td>" . $data_array['motivation'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Deine Anmerkung</td>";
            $message .= "   <td>" . $data_array['anmerkung'] . "</td>";
            $message .= "</tr>";
        $message .=  "</table>";
        $message.= "</body>";
        $message.= "</html>";
        $to      = $data_array['email'].',florenz.erstling@iaeste-freiberg.de';
        $subject = 'Deine Iaste Bewerbung';
        $headers = 'From: bewerber@iaeste-freiberg.de' . "\r\n" .
        'Content-type: text/html; charset=iso-8859-1'."\r\n" .
        'Reply-To: info@iaeste-freiberg.de' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail( $to, $subject, $message, $headers );
    }

    public function saveApplicationPersoenlich( $data ) {
        $to      = 'florenz.erstling@gmx.de';
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: florenz.erstling@gmx.de' . "\r\n" .
            'Reply-To: florenz.erstling@gmx.de' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $mailsent = mail($to, $subject, $message, $headers) ;
        if ($mailsent)
            echo "mail send";
        else
            echo "error";
        }

}


$ajax_functions = new ajax_server();
if ( isset( $_REQUEST["operation"] ) && strpos( $_REQUEST["operation"], "_" ) !== 0 && method_exists( $ajax_functions, $_REQUEST["operation"] ) ) {

    print_r( $ajax_functions->{$_REQUEST["operation"]}( $_REQUEST ) );
    die();
}
