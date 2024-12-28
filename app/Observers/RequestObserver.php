<?php

namespace App\Observers;

use App\Models\RequestChange;
use App\Models\SupportRequest;

class RequestObserver
{
    /**
     * Handle the SupportRequest "created" event.
     */
    public function created(SupportRequest $supportRequest): void
    {
        //
    }

    /**
     * Handle the SupportRequest "updated" event.
     */
    public function updated(SupportRequest $request)
    {
        $changes = $request->getChanges();
        $original = $request->getOriginal();

        foreach ($changes as $field => $newValue) {
            if (in_array($field, ['updated_at'])) {
                continue;
            }

            $oldValue = $original[$field] ?? null;

            if ($oldValue != $newValue) {
                RequestChange::create([
                    'request_id' => $request->id,
                    'changed_by' => auth()->id(),
                    'field_name' => $field,
                    'old_value' => $oldValue,
                    'new_value' => $newValue,
                ]);
            }
        }
    }


    /**
     * Handle the SupportRequest "deleted" event.
     */
    public function deleted(SupportRequest $supportRequest): void
    {
        //
    }

    /**
     * Handle the SupportRequest "restored" event.
     */
    public function restored(SupportRequest $supportRequest): void
    {
        //
    }

    /**
     * Handle the SupportRequest "force deleted" event.
     */
    public function forceDeleted(SupportRequest $supportRequest): void
    {
        //
    }
}
