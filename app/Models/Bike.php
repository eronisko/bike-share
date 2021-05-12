<?php

namespace App\Models;

use App\Events\BikeBorrowed;
use App\Events\BikeCreated;
use App\Events\BikeDeleted;
use App\Events\BikeReturned;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Bike extends Model
{
    protected $guarded = [];

    public static function createWithAttributes(array $attributes): Bike
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        event(new BikeCreated($attributes));

        return static::firstWhere('uuid', $attributes['uuid']);
    }

    public function borrow(User $user) {
        event(new BikeBorrowed($this->uuid, $user));
    }

    public function return() {
        event(new BikeReturned($this->uuid));
    }

    public function remove() // TODO meh... this name
    {
        event(new BikeDeleted($this->uuid));
    }

    public function rider()
    {
        return $this->belongsTo(User::class);
    }
}
