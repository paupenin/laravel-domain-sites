<?php

namespace Paupenin\DomainSites;

use Illuminate\Database\Eloquent\Model;

use Paupenin\DomainSites\Site;

class Domain extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url','default_locale'];

    /**
     * Relationship
     *
     * @return Site
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
