<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\V1\Bank\BankResource;
use App\Http\Resources\V1\EducationalStage\EducationalStageResource;
use App\Http\Resources\V1\Subject\SubjectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference_id' => $this->whenNotNull($this->reference_id),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'show_phone' => $this->show_phone,
            'image' => $this->image_url,
            'cv' => $this->whenNotNull($this->cv_url),
            'bio' => $this->whenNotNull($this->bio),
            'educational_stages' => $this->when($this->educationalStages?->count() !== 0, EducationalStageResource::collection($this->educationalStages)),
            'subjects' => $this->when($this->subjects?->count() !== 0, SubjectResource::collection($this->subjects)),
            'educational_stage' => $this->when($this->studentStage !== null, new EducationalStageResource($this->studentStage)),
            'is_active' => $this->is_active,
            'is_student' => $this->is_student,
            'cart_items_count' => $this->cart_items_count,
            'wallet_total_amount' => $this->whenNotNull($this->wallet?->total_amount),
            'bank' => new BankResource($this->bank),
            'bank_account_name' => $this->bank_account_name,
            'bank_account_number' => $this->bank_account_number,
            'bank_account_iban' => $this->bank_account_iban,
            'totalUnRead' => $this->totalUnRead,
            'token' => $this->token(),
        ];
    }
}
