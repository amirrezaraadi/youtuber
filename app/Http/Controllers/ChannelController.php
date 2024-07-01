<?php

namespace App\Http\Controllers;

use App\Models\User\Channel;
use App\Http\Requests\StoreChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Repository\User\channelRepo;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
   public function __construct(public channelRepo $channelRepo){}


    public function show($id)
    {
        return $this->channelRepo->getFindId($id);
    }

    public function update(Request $request)
    {
        dd($request);
    }
//    public function destroy($channel)
//    {
//        //
//    }
}
