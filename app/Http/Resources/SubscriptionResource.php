<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'plan_name' => $this->plan->name ?? 'Standard',
            'ends_at' => $this->ends_at ? $this->ends_at->format('Y-m-d H:i:s') : null,
            'is_active' => $this->status === 'active',
            'user_id' => $this->user_id,
        ];
    }
}
