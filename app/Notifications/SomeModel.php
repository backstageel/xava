<?php
//namespace App\Notifications;
//use Aws\Credentials\Credentials;
//use Aws\Sns\SnsClient;
//use Aws\Result;
//use Psr\Log\LogLevel;
//
//
//class SomeModel
//{
//    public static function sendNotificationToPhoneNumber($message, $phoneNumber)
//    {
//
//
//
//        // Your AWS credentials
//        $awsKey = env('AWS_ACCESS_KEY_ID');
//        $awsSecret = env('AWS_SECRET_ACCESS_KEY');
//        $amazonRegion = 'us-east-1';
//
//// Configuração do cliente SNS usando suas credenciais da AWS
//
//
//
//
//        // SNS client configuration using your AWS credentials
//        $client = new SnsClient([
//        'version' => '2010-03-31',
//        'region' => $amazonRegion,
//        'credentials' => new Credentials($awsKey, $awsSecret)
//        ]);
//
//
//
//        $subject = 'Xava Intranet Notification';
//        $message = json_encode(['message' => $message]);
//
//
//
//         //Send the message directly to the phone number (SMS)
////        $client->publish([
////        'PhoneNumber' => $phoneNumber,
////        'Message' => $message,
////        'Subject' => $subject
////        ]);
//
//    }
//}
//// Ler o conteúdo do arquivo de view 'emails.competition.blade.php' e passar o contexto
////        $message = view('emails.competition', compact('competitions', 'username'))->render();
//
////        $message = 'hello, Xava!';
////    use Illuminate\Support\Facades\File;
////
////// Caminho para a view que você deseja obter o conteúdo
////        $viewPath = resource_path('views/emails/competition.blade.php');
////
////// Lê o conteúdo do arquivo da view diretamente
////        $message = File::get($viewPath);
