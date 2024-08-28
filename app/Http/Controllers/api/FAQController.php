<?php

namespace App\Http\Controllers\api;

use App\Enums\FAQLangEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\FAQResource;
use App\Models\FAQ;

class FAQController extends Controller
{
    public function index_en()
    {
        $faqs_en = FAQ::where('type', FAQLangEnum::en)->get();
        return response()->json(FAQResource::collection($faqs_en));
    }
    public function index_ar()
    {
        $faqs_ar = FAQ::where('type', FAQLangEnum::ar)->get();
        return response()->json(FAQResource::collection($faqs_ar));
    }
}
