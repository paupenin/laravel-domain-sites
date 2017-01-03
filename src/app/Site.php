<?php

namespace Paupenin\DomainSites;

use Illuminate\Database\Eloquent\Model;

use Paupenin\DomainSites\Domain;

class Site extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Relationship
     *
     * @return Domains
     */
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
