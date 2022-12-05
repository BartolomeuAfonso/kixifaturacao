<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use PDF;

class EmailController extends Controller
{


    
    public function sendmail(Request $request)
    {
        $data["email"] = $request->get("email");
        $data["client_name"] = $request->get("client_name");
        $data["subject"] = $request->get("subject");

        $pdf =PDF::loadView('formulario.teste')->setPaper('a4', 'portrait')->stream('Fatura.pdf');
        try {
            Mail::send('mails.mail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        } else {

            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
    }

    public function index()
    {
        return view('formulario.Email_index');
    }
}
