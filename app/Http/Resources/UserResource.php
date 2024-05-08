<?php

namespace App\Http\Resources;

use App\Enums\ConsultationStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birth' => $this->birth,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'consultationPrice' => $this->consultation_price,
            'is_active' => $this->is_active,
            'location' => $this->location,
            'yearsOfPractice' => $this->years_of_practice,

            'numOfConsultation' => $this->consultations()->count(),
            'closedConsultation' => $this->consultations()->where('status', ConsultationStatusEnum::closed)->count(),

            'image' => $this->getFirstMediaUrl('profileUser'),

            'certification' => $this->getMedia('certification')->map(function ($media) {
                return $media->getUrl();
            }),

            'consultations' => $this->whenLoaded('consultations', function () {
                return ConsultationResource::collection($this->consultations->load(['receiver', 'sender']));
            }),

            'generalQuestions' => $this->whenLoaded('GeneralQuestions', function () {
                return GeneralQuestionsResource::collection($this->GeneralQuestions->load(['Replies', 'user']));
            }),
            'questionsReplies' => $this->whenLoaded('QuestionsReplies', function () {
                return RepliesResource::collection($this->QuestionsReplies->load(['generalQuestion', 'user']));
            }),
            'practices' => $this->whenLoaded('practices', function () {
                return PracticeResource::collection($this->practices);
            }),
            'groups' => $this->whenLoaded('groups', function () {
                return GroupResource::collection($this->groups->load('messeges'));
            }),
            'senderMessage' => $this->whenLoaded('sender_message', function () {
                return ChatResource::collection($this->sender_message->load(['receiver','sender']));
            }),
            'receiverMessage' => $this->whenLoaded('receiver_message', function () {
                return ChatResource::collection($this->receiver_message->load(['receiver','sender']));
            }),
        ];
    }
}
