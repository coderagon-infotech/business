<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include APPPATH . 'third_party/mail/class.phpmailer.php';
include APPPATH . "third_party/mail/class.smtp.php";

class Sendmail {

    public function send($toparam = array(), $subject, $html_body, $attachment = NULL) {

        $CI = & get_instance();
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = '';
        $mail->Port = '';
        $mail->From = '';
        $mail->FromName = '';

        if (isset($toparam) && count($toparam) > 0) {
            $to_email = $toparam['to_email'];
            $to_name = $toparam['to_name'];
        }

        // Main
        $html = '<table align="center" cellpadding="0" cellspacing="0" width="600px" >
                    <tr>
                        <td align="center" valign="top" width="100%">
                        <center>
                            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                                <tr>
                                    <td align="center" valign="top">
                                        <table style="margin:15px auto;" cellspacing="0" cellpadding="0" width="100%">
                                            <tr>
                                                <td style="text-align: center;">
                                                    <img class="w320" src="' . get_CompanyName() . '" alt="'. lang('Logo_Image').'">
                                                </td>
                                            </tr>
                                        </table>';
        // Main Body
        $html .= $html_body;


        // Footer
        $html .= '<table style="margin: 0 auto;width: 90%;color: #6f6f6f;" cellspacing="0" cellpadding="0">';
        $html .= '<tr>';
        $html .= '<td style="text-align: left;">
                            <br>
                              ' . lang('Thank_you').', 
                            <br>
                            ' . get_CompanyName() . '
                        </td>';
        $html .= '</tr>';
        $html .= '</table>';

        $html .= '<table cellspacing="0" cellpadding="0" bgcolor="#363636"  style="width: 100%;margin: 30px auto 0;">';
        $html .= '<tr>';
        $html .= '<td style="color:#f0f0f0; font-size: 14px; text-align:center; padding: 20px;">'
                . '© ' . date("Y") . ' ' . lang('Reserved_Message') . '
                        </td>';
        $html .= '</tr>';
        $html .= '</table>';

        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';

        $mail->addAddress($to_email, $to_name);
        if ($attachment != NULL) {
            $mail->addAttachment($attachment);
        }
        $mail->WordWrap = 50;
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $html;
        echo $html;
        exit;
        if (MAIL_SWITCH == true) {
            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        }
    }

}
