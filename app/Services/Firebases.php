<?php

namespace App\Services;

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\Notification;

class Firebases
{
    protected $messaging;
    protected $factory;
    protected $message;
    protected $notification;
    // protected
    public function __construct()
    {
        $this->factory = (new Factory)->withServiceAccount(base_path('masbro.json'));
        $this->messaging = $this->factory->createMessaging();
        $this->defaultValue();
    }

    public function withNotification(String $judul, String $body){
        $this->notification = Notification::create($judul, $body);
        return $this;
    }
    public function withData(Array $data){
        $this->message = $data;
        return $this;
    }
    public function sendMessages(?string $token)
    {
        $fcmToken = $token ?? '';
        if($fcmToken == ''){
            return false;
        }
        $cloudMessage = CloudMessage::withTarget('token', $fcmToken)
            ->withNotification($this->notification)
            ->withData($this->message);
        $this->messaging->send($cloudMessage);
    }
    public function defaultValue(){
        $this->notification = Notification::create("Selamat Datang Di Masbro Canteen", "Aplikasi Pemesanan Makanan di Kantin PENS Dengan Menerapkan Payment Gateway");
        $this->message = ["DATA" => "NO DATA"];
    }
}
