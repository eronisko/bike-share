<?php

namespace App\Events;

use App\Models\User;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class BikeBorrowed extends ShouldBeStored
{
    public $bikeUuid;
    public $riderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $bikeUuid, User $borrower)
    {
        $this->bikeUuid = $bikeUuid;
        $this->riderId = $borrower->id;
    }
}
