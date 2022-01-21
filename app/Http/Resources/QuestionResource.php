<?php

namespace App\Http\Resources;

use App\Models\Question\QuestionCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'image_path' => $this->img,
            'category' => $this->category_id ? QuestionCategory::query()->find($this->category_id)->first()->name : null,
            'created_at'=> $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
