<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FundsAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $email;
    private string $name;
    private float $amount;
    private string $time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $email, string $name, float $amount, string $time)
    {
        $this->email = $email;
        $this->name = $name;
        $this->amount = $amount;
        $this->time = $time;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
