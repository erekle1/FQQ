<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'num_of_users'           => $this->num_of_users,
            'num_of_finished'        => $this->num_of_finished,
            'num_of_correct_answers' => $this->num_of_correct_answers,
            'sum_of_answers'         => $this->sum_of_answers
        ];
    }
}
