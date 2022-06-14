<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buyer;
use App\Models\Order;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardBuyerController extends Controller
{
    public function index() {
        $buyer = Buyer::firstWhere('user_id', auth()->user()->id);
        $seller = Seller::firstWhere('user_id', auth()->user()->id);
        return view('buyers.index', [
            'title' => 'Dashboard',
            'orders' => Order::where([['check_out', '>', today()], ['buyer_id', $buyer->id],['status','!=','rejected']])->get(),
            'optionName' => 'Kos Saya',
            'seller' => $seller,
            'buyer' => Buyer::firstWhere('user_id', auth()->user()->id)
        ]);
    }

    public function edit(User $user) {
        return view('buyers.editProfile', [
            'title' => 'Edit Profile',
            'buyer' => Buyer::firstWhere('user_id', $user->id)
        ]);
    }

    public function update(Request $request, User $user) {
        $user_rules = [
            'name' => 'required',
            'email' => 'required',
        ];

        if ($request->username != $user->username) {
            $user_rules['username'] = 'required|unique:users';
        } else {
            $user_rules['username'] = 'required';
        }

        $validatedDataUser = $request->validate($user_rules);

        $buyer_rules = [
            'phone' => '',
            'photo_profile' => 'image|file|max:5120'
        ];

        $validatedDataBuyer = $request->validate($buyer_rules);

        if ($request->file('photo_profile')) {
            if ($request->old_photo_profile) {
                Storage::delete($request->old_photo_profile);
            }
            $validatedDataBuyer['photo_profile'] = $request->file('photo_profile')->store('public/buyers-photo-profile');
        }

        User::where('id', $user->id)->update($validatedDataUser);
        Buyer::where('user_id', $user->id)->update($validatedDataBuyer);

        return redirect('/dashboard')->with('success', 'Your profile has been updated!');
    }

    public function viewChangePassword() {
        return view('buyers.changePassword', [
            'title' => 'Ganti Password'
        ]);
    }

    public function changePassword(Request $request, User $user) {
        $credentials = $request->validate([
            'username' => 'required',
        ]);

        $credentials['password'] = $request->old_password;

        if (Auth::attempt($credentials)) {
            $new_password = $request->validate([
                'password' => 'required|min:8'
            ]);
            if ($new_password['password'] != $credentials['password']) {
                $request->validate([
                    're_password' => 'required|same:password'
                ]);
                $new_password['password'] = Hash::make($new_password['password']);
                // dd($new_password['password']);
                User::where('id', auth()->user()->id)->update($new_password);

                return redirect('/dashboard')->with('success', 'Your password has been updated!');
            }
        }
        return back()->with('error', 'There is an error!');
    }

    public function becomeSeller() {
        $seller = Seller::firstWhere('user_id', auth()->user()->id);
        return view('buyers.upgradeToSeller', [
            'optionName' => 'Jadi Seller',
            'title' => 'Jadi Seller',
            'seller' => $seller,
            'buyer' => Buyer::firstWhere('user_id', auth()->user()->id)
        ]);
    }

    public function requestToAdmin(Request $request) {
        $validatedData = $request->validate([
            'nik' => 'required|size:16|unique:sellers',
            'address' => 'required',
            'phone' => 'required|unique:sellers',
            'photo_ktp' => 'required|image|file|max:5120',
            'photo_selfie' => 'required|image|file|max:5120',
            'user_id' => 'required'
        ]);

        $validatedData['photo_ktp'] = $request->file('photo_ktp')->store('ktps');
        $validatedData['photo_selfie'] = $request->file('photo_selfie')->store('selfies');

        Seller::create($validatedData);

        return redirect('/dashboard')->with('success', 'Your request has been sent.');
    }

    public function history() {
        $buyer = Buyer::firstWhere('user_id', auth()->user()->id);
        return view('buyers.history', [
            'title' => 'Riwayat Kos',
            'buyer' => $buyer,
            'seller' => Seller::firstWhere('user_id', auth()->user()->id),
            'orders' => Order::where([['check_out', '<=', today()], ['buyer_id', $buyer->id]])->get()
        ]);
    }
}
