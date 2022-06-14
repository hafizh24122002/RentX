<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Property;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardAdminController extends Controller
{
    public function index() {
        return view('admin.dashboard', [
            'title' => 'Admin',
            'admin' => auth()->user(),
            'sellers' => Seller::where('status', 'accepted')->get(),
            'buyers' => Buyer::all(),
            'requests' => Seller::where('status', 'pending')->get(),
            'properties' => Property::all()
        ]);
    }

    public function listSellers() {
        return view('admin.daftarSeller', [
            'title' => 'Daftar Seller',
            'admin' => auth()->user(),
            'sellers' => Seller::where('status', 'accepted')->get(),
        ]);
    }

    public function listBuyers() {
        return view('admin.daftarBuyer', [
            'title' => 'Daftar Buyer',
            'admin' => auth()->user(),
            'buyers' => Buyer::all()
        ]);
    }

    public function requestUpgrade() {
        return view('admin.requestUpgrade', [
            'title' => 'Request Upgrade',
            'requests' => Seller::where('status', 'pending')->get(),
            'admin' => auth()->user()
        ]);
    }

    public function showRequest(User $user) {
        return view('admin.showRequest', [
            'title' => 'Request Upgrade',
            'requester' => Seller::firstWhere('user_id', $user->id),
            'admin' => auth()->user()
        ]);
    }

    public function acceptRequest(Request $request, User $user) {
        $validatedData = $request->validate([
            'status' => 'required'
        ]);

        $user->account_type = 'seller';
        $user->save();

        Seller::where('user_id', $user->id)->update($validatedData);

        return redirect('/admin/requestUpgrade');
    }

    public function rejectRequest(User $user) {
        $user->account_type = 'buyer';
        $user->save();

        $seller = Seller::firstWhere('user_id', $user->id);
        Storage::delete($seller->photo_ktp);
        Storage::delete($seller->photo_selfie);

        Seller::destroy($seller->id);

        return redirect('/admin/requestUpgrade');
    }
}
