<?php

namespace App\Http\Resources;

use App\Enums\CountryEnum;
use App\Enums\SaudiCityEnum;
use App\Enums\UAECityEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {

            $country_value = intval($this->country);
            $city_value = intval($this->city);
            $country = $this->country == null ? 'unknow' : CountryEnum::getKey($country_value);

            if ($country_value === CountryEnum::Saudi) {
                $city =  SaudiCityEnum::getKey($city_value);
            } elseif ($country_value === CountryEnum::UAE) {
                $city = UAECityEnum::getKey($city_value);
            }
            else {
                $city = 'unknow';
            }

        return [
            'id' => $this->id,
            'isActive' => $this->is_active == null ? false : true,
            'role' => $this->getRoleNames()->first(),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender == 1 ? 'male' : 'female',
            'birth' => $this->birth,
            'country' => $country,
            'city' => $city,
            'emiratesId' => $this->emirates_id,
            'frontEmiratesId' => $this->getFirstMediaUrl('front_emirates_id'),
            'backEmiratesId' => $this->getFirstMediaUrl('back_emirates_id'),
            'profile' => $this->getFirstMediaUrl('profile'),

            'client' => $this->whenLoaded('client', function () {
                return new ClientResource($this->client);
            }),

            'lawyer' => $this->whenLoaded('lawyer', function () {
                return new LawyerResource($this->lawyer);
            }),

            'consultationsReceiver' => $this->whenLoaded('consultations_receiver', function () {
                return ConsultationResource::collection($this->consultations_receiver->load('sender', 'receiver'));
            }),

            'consultationsSender' => $this->whenLoaded('consultations_sender', function () {
                return ConsultationResource::collection($this->consultations_sender->load('sender', 'receiver'));
            }),

            'casesSender' => $this->whenLoaded('cases_sender', function () {
                return CaseResource::collection($this->cases_sender->load('sender', 'receiver'));
            }),
            'casesReceiver' => $this->whenLoaded('cases_receiver', function () {
                return CaseResource::collection($this->cases_receiver->load('sender', 'receiver'));
            }),

            'practices' => $this->whenLoaded('practices', function () {
                return PracticeResource::collection($this->practices);
            }),

            'languages' => $this->whenLoaded('languages', function () {
                return LanguageResource::collection($this->languages);
            }),

            'invoiceSender' => $this->whenLoaded('invoice_sender', function () {
                return InvoiceResource::collection($this->invoice_sender->load(['sender', 'receiver', 'case', 'consultation']));
            }),
            'invoiceReceiver' => $this->whenLoaded('invoice_receiver', function () {
                return InvoiceResource::collection($this->invoice_receiver->load(['sender', 'receiver', 'case', 'consultation']));
            }),

            'generalQuestions' => $this->whenLoaded('general_questions', function () {
                return GeneralQuestionsResource::collection($this->general_questions);
            }),

            'questionsReplies' => $this->whenLoaded('questions_replies', function () {
                return RepliesResource::collection($this->questions_replies);
            }),
            // 'numOfConsultation' => $this->consultations()->count(),
            // 'closedConsultation' => $this->consultations()->where('status', ConsultationStatusEnum::closed)->count(),

            'unreadNotifications' => $this->whenLoaded('unreadNotifications', function () {
                return NotificationResource::collection($this->unreadNotifications);
            }),

            'groups' => $this->whenLoaded('groups', function () {
                return GroupResource::collection($this->groups);
            }),

            'generalChats' => $this->whenLoaded('general_chats', function () {
                return GroupResource::collection($this->general_chats);
            }),

            'senderMessage' => $this->whenLoaded('sender_message', function () {
                return ChatResource::collection($this->sender_message->load(['receiver', 'sender']));
            }),
            'receiverMessage' => $this->whenLoaded('receiver_message', function () {
                return ChatResource::collection($this->receiver_message->load(['receiver', 'sender']));
            }),
        ];
    }
}
