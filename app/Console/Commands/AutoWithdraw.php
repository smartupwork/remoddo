<?php

namespace App\Console\Commands;


use App\Models\UserBalance;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class AutoWithdraw extends Command
{
    private StripeClient $stripe;

    public function __construct()
    {
        parent::__construct();
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:withdraw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Withdrawing user balance';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $users=DB::table('users as u')
                ->select('u.id','ub.amount', 'sa.account_id')
                ->leftJoin('stripe_accounts as sa', 'u.id', '=', 'sa.user_id')
                ->leftJoin('user_balances as ub', 'u.id', '=', 'ub.user_id')
                ->where('ub.amount','>',0)
                ->whereNotNull('sa.account_id')
                ->get();

            $ids=[];
             if ($users->count()>0){
                 foreach ($users as $user){
                     $this->stripe->transfers->create([
                         "amount" => (int)$user->amount * 100,
                         "destination" => "{$user->account_id}",
                         "currency" => config('cashier.currency'),
                     ]);
                     $ids[]=$user->id;
                 }
             }
            UserBalance::whereIn('user_id',$ids)->update(['amount'=>0]);
           info('payment completed');
        }catch (\Exception $exception){
            Log::channel('stripe_account')->error($exception->getMessage());
        }
    }
}
