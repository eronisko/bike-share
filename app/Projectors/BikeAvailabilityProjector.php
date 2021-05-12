<?php

namespace App\Projectors;

use App\Events\BikeBorrowed;
use App\Events\BikeCreated;
use App\Events\BikeDeleted;
use App\Events\BikeReturned;
use App\Models\Bike;
use App\Models\User;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class BikeAvailabilityProjector extends Projector
{
    public function onBikeCreated(BikeCreated $event)
    {
        Bike::create($event->bikeAttributes);
    }

    public function onBikeBorrowed(BikeBorrowed $event)
    {
        $bike = Bike::firstWhere('uuid', $event->bikeUuid);
        $rider = User::firstWhere('id', $event->riderId);

        $bike->rider()->associate($rider);

        $bike->save();
    }

    public function onBikeReturned(BikeReturned $event)
    {
        $bike = Bike::firstWhere('uuid', $event->bikeUuid);

        $bike->rider()->dissociate();

        $bike->save();
    }

    public function onBikeDeleted(BikeDeleted $event)
    {
        Bike::firstWhere('uuid', $event->bikeUuid)->delete();
    }
}
