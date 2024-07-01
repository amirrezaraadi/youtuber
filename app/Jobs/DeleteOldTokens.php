<?php
namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

class DeleteOldTokens implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {

    }

    public function handle(): void
    {
        Log::info('dsadasd');
        $fiveMonthsAgo = Carbon::now()->subMonths(5);
        PersonalAccessToken::where('last_used_at', '<', $fiveMonthsAgo)->delete();
    }
}
