<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * @property mixed $data
 */
class EventDataRates implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected array $data;
    /**
     * Create a new event instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function broadcastWith() : array
    {
        return $this->data;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('get-last-data');
    }
    public function broadcastAs() : string
    {
        return 'EventDataRates';
    }
}
