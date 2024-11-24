<?php

namespace App\Console\Commands;

use App\Repository\SubscriptionRepositoryInterface;
use Illuminate\Console\Command;

class EndExpiredSubscriptions extends Command
{
    public function __construct(
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:end-expired-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ending expired subscriptions depending on its `ends_at` attribute.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->subscriptionRepository->endExpiredSubscriptions();
    }
}
