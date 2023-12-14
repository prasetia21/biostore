<?php

namespace App\Listeners;

use App\Events\UserReferred;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ReferralLink;
use App\Models\ReferralRelationship;
use App\Models\ReferralPoin;
use App\Models\Point;

class RewardUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserReferred $event): void
    {
        $point = 100;
        $referral = ReferralLink::find($event->referralId);
        if (!is_null($referral)) {
            ReferralRelationship::create(['referral_link_id' => $referral->id, 'user_id' => $event->user->id]);
            Point::create(['referal_from' => $event->user->id, 'user_id' => $referral->user->id, 'referral_link_id' => $referral->id, 'add_poin' => $point]);

        
            // if ($referral->program->name === 'Sign-up Bonus') {
            //     // User who was sharing link
            //     $provider = $referral->user;
            //     $provider->addCredits(15);
            //     // User who used the link
            //     $user = $event->user;
            //     $user->addCredits(20);
            // }

        }
    }


}