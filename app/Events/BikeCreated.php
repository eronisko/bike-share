<?php

namespace App\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class BikeCreated extends ShouldBeStored
{
    public array $bikeAttributes;

    public function __construct(array $bikeAttributes)
    {
        $this->bikeAttributes = $bikeAttributes;
    }
}
