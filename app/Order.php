<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'date', 'nOrder', 'state', 'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_details')->withPivot('quantity', 'subTotal');
    }

    public function sendPDF($destino, $idArchivo){
        $to = $destino;
        //sender
        $from = 'contacto@bitstoresv.com';
        $fromName = 'Bitstore';

        //email subject
        $subject = 'Detalle de compra'; 

        //attachment file path
        $file = public_path() . "/pdf/" . $idArchivo . ".pdf";

        //email body content
        $htmlContent = '<h1>Gracias por tu compra</h1>
            <p>Bitstore te adjunta el detalle de la compra.</p>';

        //header for sender info
        $headers = "From: $fromName"." <".$from.">";

        //boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

        //headers for attachment 
        $headers .= "nMIME-Version: 1.0n" . "Content-Type: multipart/mixed;n" . " boundary='{$mime_boundary}'"; 

        //multipart boundary 
        $message = "--{$mime_boundary}n" . "Content-Type: text/html; charset='UTF-8'n" .
        "Content-Transfer-Encoding: 7bitnn" . $htmlContent . "nn"; 

        //preparing attachment
        if(!empty($file) > 0){
            if(is_file($file)){
                $message .= "--{$mime_boundary}n";
                $fp =    @fopen($file,"rb");
                $data =  @fread($fp,filesize($file));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name='".basename($file)."'n" . 
                "Content-Description: ".basename($file)."n" .
                "Content-Disposition: attachment;n" . " filename='".basename($file)."'; size=".filesize($file).";n" . 
                "Content-Transfer-Encoding: base64nn" . $data . "nn";
            }
        }
        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $from;

        //send email
        $mail = @mail($to, $subject, $message, $headers, $returnpath); 

    }
}
