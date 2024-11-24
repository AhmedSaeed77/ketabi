<?php

namespace App\Http\Resources\V1\Wallet;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'type_value' => $this->type_value,
            'from' => $this->from,
            'reason' => $this->reason,
            'amount' => $this->amount,
            'is_withdrawable' => $this->whenNotNull($this->is_withdrawable),
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('d M Y h:ia')
        ];
    }
}
