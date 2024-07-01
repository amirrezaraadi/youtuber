<?php


namespace App\Repository\User ;
use App\Models\User\Channel;

class channelRepo
{

    public function getFindId($id)
    {
        return Channel::query()->where('id' , $id)->with(['user' => function ($q) {
            return $q->select(['name' , 'id'])->first();
        }])->first();
    }

}
