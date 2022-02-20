<?php

namespace App\Http\Resources;

use App\Models\Question\QuestionAnswer;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionShowResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'question' => $this->value,
            'answers' => $this->answers()->where('is_delete','=',0)->get(),
        ];
    }
}
