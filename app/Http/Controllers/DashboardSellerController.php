<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Seller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Seller::firstWhere('user_id', auth()->user()->id);
        return view('sellers.dashboard.index', [
            'title' => 'Daftar Property',
            'optionName' => 'Daftar Property',
            'properties' => Property::where('seller_id', $seller->id)->get(),
            'seller' => Seller::firstWhere('user_id', auth()->user()->id)
            // 'profile' => Seller::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sellers.dashboard.create', [
            'title' => 'Tambah'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'title' => 'required|max:150',
            'slug' => 'required|unique:properties',
            'property_type' =>'required',
            'rent_for' => 'required',
            'total_room' => 'required',
            'available_room' => 'required',
            'room_length' => 'required',
            'room_width' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'address' =>'required|max:255',
            'link_location' =>'required' ,
            'price' => 'required',
            'photo_1' => 'required|image|file|max:5120',
            'photo_2' => 'required|image|file|max:5120',
            'photo_3' => 'required|image|file|max:5120',
            'photo_4' => 'required|image|file|max:5120',
            'photo_5' => 'required|image|file|max:5120',
            'description' => 'required|max:500',
        ]);
        $validatedData['photo_1'] = $request->file('photo_1')->store('property-images');
        $validatedData['photo_2'] = $request->file('photo_2')->store('property-images');
        $validatedData['photo_3'] = $request->file('photo_3')->store('property-images');
        $validatedData['photo_4'] = $request->file('photo_4')->store('property-images');
        $validatedData['photo_5'] = $request->file('photo_5')->store('property-images');

        $validatedData['rating'] = 0;
        $validatedData['total_reviewer'] = 0;

        $seller = Seller::firstWhere('user_id', auth()->user()->id);
        $validatedData['seller_id'] = $seller->id;

        Property::create($validatedData);

        return redirect('/seller/dashboard/')->with('success', 'Property has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function showOrder()
    {

        $seller = Seller::firstWhere('user_id', auth()->user()->id);
        $orders = Order::with(['seller', 'buyer', 'property']);
        $orders = $orders->where([['seller_id','=',$seller->id],['status','=','pending']])->get();

        return view('sellers.dashboard.transaksi', [
            'title' => 'Order Property',
            'optionName' => 'Order Property',
            'orders' => $orders,
            'seller' => $seller
            // 'profile' => Seller::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function showTransaction()
    {
        $seller = Seller::firstWhere('user_id', auth()->user()->id);
        $orders = Order::with(['seller', 'buyer', 'property']);
        $orders = $orders->where([['seller_id','=',$seller->id],['status','=','pending']])->get();

        return view('sellers.dashboard.transaksi', [
            'title' => 'Order Property',
            'optionName' => 'Order Property',
            'orders' => $orders
            // 'profile' => Seller::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function orderAction(Request $request, Order $order){
        $data = $request->validate([
            'status' => 'required'
        ]);
        Order::where('id', $order->id)->update($data);

        if ($request->status === 'rejected') {
            return redirect('/seller/dashboard/orders')->with('success', 'Order has been rejected');
        }

        return redirect('/seller/dashboard/orders')->with('success', 'Order has been accepted');
        // if($request->status=='accepted'){

        //     $data = $request->validate(['status'=>"required"]);
        //     Order::where('id', $order->id)->update($data);

        //     //update is_availabe di tabel property
        //     $order->property->is_available = 0;
        //     $order->save();

        //     return redirect('/seller/orders')->with('success', 'Order has been accepted');
        // }else if($request->status=='rejected'){
        //     $data = $request->validate(['status'=>"required"]);
        //     Order::where('id', $order->id)->update($data);

        //     return redirect('/seller/orders')->with('success', 'Order has been rejected');
        // }

        //Property::where('id', $property->id)->update($validatedData);
        // Order::where('id', $order->id)->update->($order);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('sellers.dashboard.edit', [
            'title' => "Update",
            'property' => $property
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        // dd($request);
        $rules = [
            'title' => 'required|max:150',
            'property_type' =>'required',
            'rent_for' => 'required',
            'total_room' => 'required',
            'available_room' => 'required',
            'room_length' => 'required',
            'room_width' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'address' =>'required|max:255',
            'link_location' =>'required' ,
            'price' => 'required',
            'photo_1' => 'image|file|max:5120',
            'photo_2' => 'image|file|max:5120',
            'photo_3' => 'image|file|max:5120',
            'photo_4' => 'image|file|max:5120',
            'photo_5' => 'image|file|max:5120',
            'description' => 'required|max:500',
        ];

        if ($request->slug != $property->slug) {
            $rules['slug'] = 'required|unique:properties';
        } else {
            $rules['slug'] = 'required';
        }

        // dd($validatedData);

        $validatedData = $request->validate($rules);

        if ($request->photo_1) {
            if ($request->photo_1 != $property->photo_1) {
                Storage::delete($property->photo_1);
                $validatedData['photo_1'] = $request->file('photo_1')->store('property-images');
            }
        }
        if ($request->photo_2) {
            if ($request->photo_2 != $property->photo_2) {
                Storage::delete($property->photo_2);
                $validatedData['photo_2'] = $request->file('photo_2')->store('property-images');
            }
        }
        if ($request->photo_3) {
            if ($request->photo_3 != $property->photo_3) {
                Storage::delete($property->photo_3);
                $validatedData['photo_3'] = $request->file('photo_3')->store('property-images');
            }
        }
        if ($request->photo_4) {
            if ($request->photo_4 != $property->photo_4) {
                Storage::delete($property->photo_4);
                $validatedData['photo_4'] = $request->file('photo_4')->store('property-images');
            }
        }
        if ($request->photo_5) {
            if ($request->photo_5 != $property->photo_5) {
                Storage::delete($property->photo_5);
                $validatedData['photo_5'] = $request->file('photo_5')->store('property-images');
            }
        }

        // $seller = Seller::firstWhere('user_id', auth()->user()->id);
        // $validatedData['seller_id'] = $seller->id;


        Property::where('id', $property->id)->update($validatedData);

        return redirect('/seller/dashboard/')->with('success', 'Property has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        Storage::delete($property->photo_1);
        Storage::delete($property->photo_2);
        Storage::delete($property->photo_3);
        Storage::delete($property->photo_4);
        Storage::delete($property->photo_5);

        Property::destroy($property->id);

        return redirect('/seller/dashboard')->with('success', 'Post has been deleted!');
    }

    public function editProfile(User $user) {
        return view('sellers.editProfile', [
            'title' => 'Edit Profile',
            'seller' => Seller::firstWhere('user_id', $user->id)
        ]);
    }

    public function updateProfile(Request $request, User $user) {
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

        $seller_rules = [
            'phone' => '',
            'address' => '',
            'photo_profile' => 'image|file|max:5120'
        ];

        $validatedDataSeller = $request->validate($seller_rules);

        if ($request->file('photo_profile')) {
            if ($request->old_photo_profile) {
                Storage::delete($request->old_photo_profile);
            }
            $validatedDataSeller['photo_profile'] = $request->file('photo_profile')->store('sellers-photo-profile');
        }

        User::where('id', $user->id)->update($validatedDataUser);
        Seller::where('user_id', $user->id)->update($validatedDataSeller);

        return redirect('seller/dashboard')->with('success', 'Your profile has been updated!');
    }

    public function viewChangePassword() {
        return view('sellers.changePassword', [
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

                return redirect('/seller/dashboard')->with('success', 'Your password has been updated!');
            }
        }
        return back()->with('error', 'There is an error!');
    }

    public function history() {
        $seller = Seller::firstWhere('user_id', auth()->user()->id);
        return view('sellers.history', [
            'title' => 'Riwayat Transaksi',
            'seller' => $seller,
            'orders' => Order::where('seller_id', $seller->id)->get(),
            'optionName' => 'Riwayat Transaksi',
        ]);
    }

    public function checkSlug(Request $request) {
        $slug = SlugService::createSlug(Property::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}
