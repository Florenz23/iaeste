<?php
//https://github.com/joshcam/PHP-MySQLi-Database-Class
require_once 'MysqliDb.php';
require 'php_mailer/PHPMailerAutoload.php';
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

    public function sendMailNew($jojo)
    {
        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mailout.one.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'florenz.erstling@lalalama.de';                 // SMTP username
        $mail->Password = '23Safreiiy';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to

        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('florenz.erstling@gmx.de', 'Joe User');     // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }


    }


    public function sendMail( $data_array ) {

        $message .= "</table>";
        $message = '<html>
                    <head>
                        <title>Iaese Bewerbung</title>
                    </head>

                    <body>
                    <h1>Hallo '.$data_array['vorname'].', vielen Dank, dass du dich für Iaste entschieden hast, du wirst es nicht bereuen!</h1>

                    <p><a href="http://iaeste-freiberg.de/iaeste_neu/outgoing.html">Hier</a> kannst du untere Bewerbungsverfahren weitere Infos zum Ablauf bekommen oder kontaktiere uns unter info(at)iaeste-freiberg.de</p>
                    <p>Hier noch einmal im Detail alle Informationen, die du in deiner Bewerbung angegeben hast.</p>';

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
            $message .= "   <td>Andere Sprachen, die du sprichst.</td>";
            $message .= "   <td>" . $data_array['andereSprachen'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Programmiersprachen</td>";
            $message .= "   <td>" . $data_array['programmiersprachen'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Cad-Kenntnisse</td>";
            $message .= "   <td>" . $data_array['cad'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Sonstiges</td>";
            $message .= "   <td>" . $data_array['sonstiges'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Praktische Erfahrung, die du mitbringst.</td>";
            $message .= "   <td>" . $data_array['praktischeErfahrung'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Praktikum bereits absolviert:</td>";
            $message .= "   <td>" . $data_array['praktikumAbsolviert'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Gewuenschte Dauer</td>";
            $message .= "   <td>" . $data_array['gewuenschteDauer'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Gewuenschter Zeitraum</td>";
            $message .= "   <td>" . $data_array['gewuenschterZeitraum'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Interessen im Praktikum</td>";
            $message .= "   <td>" . $data_array['interessenPraktikum'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Dir ist dein Resieziel egal.</td>";
            $message .= "   <td>" . $data_array['landEgal'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Du möchtest nach Europa.</td>";
            $message .= "   <td>" . $data_array['landEuropa'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Du möchstest nach Amerka.</td>";
            $message .= "   <td>" . $data_array['landAmerika'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Du möchtest nacht Asien</td>";
            $message .= "   <td>" . $data_array['landAsien'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Du möchtest nacht Afrika</td>";
            $message .= "   <td>" . $data_array['landAfrika'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr>";
            $message .= "   <td>Deine Wunschländer sind.</td>";
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
        $to      = $data_array['email'].',info@iaeste-freiberg.de,florenz.erstling@iaeste-freiberg.de';
        $subject = 'Deine Iaste Bewerbung';
        $headers = 'From: info@iaeste-freiberg.de' . "\r\n" .
        'Content-type: text/html; charset=utf-8'."\r\n" .
        'Reply-To: info@iaeste-freiberg.de' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail( $to, $subject, $message, $headers );
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
        } else{
            echo '{"status":"'.$this->db->getLastError().'"}';
            return;
        };
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
        } else{
            echo '{"status":"'.$this->db->getLastError().'"}';
            return;
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
        } else{
            echo '{"status":"'.$this->db->getLastError().'"}';
            return;
        }
        if ( $id ) {
            $data = array (
                'id' => $id,
                'motivation' => $old_data['motivation'],
                'anmerkung' => $old_data['anmerkung'],
            );
            $id = $this->db->insert ( 'iaeste_apply_sonstiges', $data );
        } else{
            echo '{"status":"'.$this->db->getLastError().'"}';
            return;
        }
        if ( $id ) {

            echo '{"status":"ok","id":"'.$id.'"}';
            $this->sendMail( $old_data );
        }
        else {
            echo '{"status":"'.$this->db->getLastError().'"}';
        }
    }

}


$ajax_functions = new ajax_server();
if ( isset( $_REQUEST["operation"] ) && strpos( $_REQUEST["operation"], "_" ) !== 0 && method_exists( $ajax_functions, $_REQUEST["operation"] ) ) {

    print_r( $ajax_functions->{$_REQUEST["operation"]}( $_REQUEST ) );
    die();
}
