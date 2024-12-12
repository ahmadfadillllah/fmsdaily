<?php

namespace App\Traits;

trait HasDraft
{
    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }

    public function scopePublished($query)
    {
        return $query->where('is_draft', false);
    }

    public function markAsDraft()
    {
        $this->is_draft = true;
        $this->save();
    }

    public function publish()
    {
        $this->is_draft = false;
        $this->save();
    }
}
