<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Services\ParameterService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ContactController extends Controller
{
    public function __construct(
        private readonly ParameterService $parameterService,
    ) {}

    public function Store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'phone' => ['required'],
            'message' => ['nullable']
        ]);

        if ($valid->fails()) {
            return response()->json(['status' => 400, 'message' => 'All fields are required'], 400);
        }
        $mailSettings = $this->parameterService->getEmailCredentials();


        try {
            Config::set('mail.mailers.smtp', [
                'transport' =>  $mailSettings['MAIL_MAILER'],
                'host'       => $mailSettings['MAIL_HOST'],
                'port'       => $mailSettings['MAIL_PORT'],
                'encryption' => null,
                'username'   => $mailSettings['MAIL_USERNAME'],
                'password'   => $mailSettings['MAIL_PASSWORD'],
                'timeout'    => null,
            ]);

            Config::set('mail.default', 'smtp');
            $contactEmails = $this->parameterService->getContactFormEmails();
            if ($contactEmails) {

                $mail = Mail::to($contactEmails['email']);

                if (!empty($contactEmails['bcc_email'])) {
                    $mail->bcc($contactEmails['bcc_email']);
                }
                $mail->send(new ContactEmail($request->all()));
                Log::info('Contact form was sent: ' . $request);
                return response()->json(['status' => 200, 'message' => 'success'], 200);
            }
        } catch (Exception $throwable) {
            Log::error('Cannot send contact form: ' . $throwable->getMessage());
            return response()->json(['status' => 400, 'message' => 'something went wrong'], 400);
        }
    }
}
