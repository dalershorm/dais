<?php

namespace App\Http\Traits;

use App\Models\Announcement;

trait AnnouncementBuilder {

    public function getRentedObjectsAttribute()
    {
        if ($this->user){
            return Announcement::where('is_active', 1)->where('type', 1)->where('status_id', 1)->where('user_id', $this->user->id)->count();
        }
        return 0;
    }

    public function getObjectsUnderConstructionAttribute()
    {
        if ($this->user){
            return Announcement::where('is_active', 1)->where('type', 1)->where('status_id', 2)->where('user_id', $this->user->id)->count();
        }
        return 0;
    }
}