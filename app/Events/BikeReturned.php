<?php

namespace App\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class BikeReturned extends ShouldBeStored
{
    public string $bikeUuid;

    public function __construct(string $bikeUuid)
    {
        $this->bikeUuid = $bikeUuid;
    }
}
