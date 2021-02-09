<?php
namespace App\Helpers;

class MailHelper
{

    static function prepareEmail($userObj){
        $emailData['firstName'] = $userObj->name;
        $emailData['subject'] = 'تأكيد العضوية :';
        $emailData['content'] = $userObj->reply;
        $emailData['to'] = $userObj->email;
        $emailData['template'] = "emailUsers.emailReplied";
        return self::SendMail($emailData);
    }

    static function SendMail($emailData){

        \Mail::send($emailData['template'], $emailData, function ($message) use ($emailData) {

            $fromEmailAddress = 'noreply@alshabalriyadi.com';
            $fromDisplayName = 'الشاب الريادي';

            if(isset($emailData['fromEmailAddress'])){
                $fromEmailAddress = $emailData['fromEmailAddress'];
            }

            if(isset($emailData['fromDisplayName'])) {
                $fromDisplayName = $emailData['fromDisplayName'];
            }

            $message->from($fromEmailAddress, $fromDisplayName);

            $message->to($emailData['to'])->subject($emailData['subject']);

        });
    }
}
