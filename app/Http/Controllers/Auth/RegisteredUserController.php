<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ReferralRelationship;
use App\Models\ReferralLink;
use App\Models\Point;
use App\Models\PointHistory;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\URL;
use Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function createReferral(Request $request)
    {
        if (isset($request->ref)) {
            $referral = $request->ref;
            $userData = User::where('referral_code', $referral)->get();

            if (count($userData) > 0) {
                return view('auth.referralRegister', compact('referral'));
            } else {
                return view('errors.404');
            }
        } else {
            return redirect('/');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $regPoin = 1000;
        $reffSharePoin = 500;
        $reffChildPoin = 200;
        $reffTotalChildPoin = $regPoin + $reffChildPoin;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $referralCode = Str::random(10);

        $domain = URL::to('/');
        $urlRef = $domain . '/referral-register?ref=' . $referralCode;

        if (isset($request->referral_code)) {

            $userData = User::where('referral_code', $request->referral_code)->get();
            $userAddPoint = Point::where('user_id', $userData[0]['id'])->get();

            // new poin user with referral
            $newTotalSharePoint = $userAddPoint[0]['total_poin'] + $reffSharePoin;

            if (count($userData)) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => strtolower(str_replace(' ', '-', $request->name)),
                    'password' => Hash::make($request->password),
                    'referral_code' => $referralCode,
                ]);

                ReferralLink::insert([
                    'user_id' => $user->id,
                    'referral_program_id' => 1,
                    'url' => $urlRef,
                ]);

                ReferralRelationship::insert([
                    'referral_code' => $request->referral_code,
                    'user_id' => $userData[0]['id'],
                    'referal_user_id' => $user->id,
                ]);

                // point share link
                Point::where('user_id', $userData[0]['id'])->update(
                    array('total_poin' => $newTotalSharePoint)
                );


                PointHistory::insert([
                    'referal_from' => $user->id,
                    'user_id' => $userData[0]['id'],
                    'add_poin' => $reffSharePoin,
                    'source' => 'Referral Bonus',
                ]);

                // point register with referal link
                Point::insert([
                    'user_id' => $user->id,
                    'total_poin' => $reffTotalChildPoin,
                    'expired_point' => Carbon::now()->addYear(),
                ]);

                PointHistory::insert([
                    'user_id' => $user->id,
                    'add_poin' => $regPoin,
                    'source' => 'Registration Bonus',

                ]);

                PointHistory::insert([
                    'referal_from' => $userData[0]['id'],
                    'user_id' => $user->id,
                    'add_poin' => $reffChildPoin,
                    'source' => 'Referral Bonus',

                ]);
            } else {
                return back()->with('error', 'Kode Referal Tidak Valid ');
            }
        } else {

            $user = User::create([
                'name' => $request->name,
                'username' => strtolower(str_replace(' ', '-', $request->name)),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'referral_code' => $referralCode,
            ]);

            ReferralLink::insert([
                'user_id' => $user->id,
                'referral_program_id' => 1,
                'url' => $urlRef,
            ]);

            Point::insert([
                'user_id' => $user->id,
                'total_poin' => $regPoin,
                'expired_point' => Carbon::now()->addYear(),
            ]);

            PointHistory::insert([
                'user_id' => $user->id,
                'add_poin' => $regPoin,
                'source' => 'Registration Bonus',
            ]);
        }

        $domain = URL::to('/');
        $url = $domain . '/referral-register?ref=' . $referralCode;

        $data['url'] = $url;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['title'] = 'Registered';

        Mail::send('mail.registerMail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });

        event(new Registered($user));


        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}