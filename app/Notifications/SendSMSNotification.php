<?php
//
//namespace App\Notifications;
//
//use Illuminate\Bus\Queueable;
//use Illuminate\Notifications\Notification;
//use NotificationChannels\AwsSns\SnsChannel;
//use NotificationChannels\AwsSns\SnsMessage;
//
//
//class SendSMSNotification extends Notification
//{
//    use Queueable;
//
//    protected $message;
//
//    /**
//     * Create a new notification instance.
//     *
//     * @param string $message
//     */
//    public function __construct(string $message)
//    {
//        $this->message = $message;
//    }
//
//    /**
//     * Get the notification's delivery channels.
//     *
//     * @param  mixed  $notifiable
//     * @return array
//     */
//    public function via($notifiable)
//    {
//        return [SnsChannel::class];
//    }
//
//    /**
//     * Get the SNS representation of the notification.
//     *
//     * @param  mixed  $notifiable
//     * @return \NotificationChannels\AwsSns\SnsMessage
//     */
//
//    public function toSns($notifiable)
//    {
//        // You can just return a plain string:
//        return "Your {$notifiable->service} account was approved!";
//
////        // OR explicitly return a SnsMessage object passing the message body:
////        return new SnsMessage("Your {$notifiable->service} account was approved!");
////
////        // OR return a SnsMessage passing the arguments via `create()` or `__construct()`:
////        return SnsMessage::create([
////            'body' => "Your {$notifiable->service} account was approved!",
////            'transactional' => true,
////            'sender' => 'MyBusiness',
////        ]);
////
////        // OR create the object with or without arguments and then use the fluent API:
////        return SnsMessage::create()
////            ->body("Your {$notifiable->service} account was approved!")
////            ->promotional()
////            ->sender('MyBusiness');
//    }
//}
//
//
