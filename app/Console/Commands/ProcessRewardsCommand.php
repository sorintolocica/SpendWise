<?php

namespace App\Console\Commands;

use App\Models\Reward;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ProcessRewardsCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process-rewards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process user rewards';

    /**
     * Execute the console command.
     */
    public function handle() {
        $today = Carbon::now();
        $start = $today->startOfMonth()->format('Y-m-d');
        $end = $today->endOfMonth()->format('Y-m-d');

        $users = User::with('rewardThisMonth')->withSum([
            'expenses' => function ($query) use ($start, $end) {
                $query->whereBetween('date', [$start, $end]);
            }
        ], 'Amount')
            ->withSum('monthlyBudget', 'Amount')
            ->get();

        if(!$users) {
            return false;
        }

        foreach($users as $user) {
            if($user->rewardThisMonth->count()) {
                continue;
            }

            $diff = $user->monthly_budget_sum_amount - $user->expenses_sum_amount;

            if($diff > 0) {
                $points = $diff / 100;
                if($points) {
                    $reward = new Reward();
                    $reward->user_id = $user->id;
                    $reward->description = 'User-ul a cheltuit '.$user->expenses_sum_amount.' din '. $user->monthly_budget_sum_amount .' si a primit '. $points .' puncte';
                    $reward->points = $points;
                    $reward->save();
                }
            }

        }

        return true;
    }

}
