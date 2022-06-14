<div class="col-3 p-3">
    <!-- identity section -->
    <div class="row mb-3">
        <div class="col">
            @if ($seller->photo_profile)
                <img src="{{ asset('storage/' . $seller->photo_profile) }}" class="rounded img-fluid" alt="Avatar">
            @else
                <img src="/img/blank-profile-picture.png" class="rounded img-fluid" alt="Avatar">
            @endif
        </div>
        <div class="col">
            <div class="row mt-1">
                <p class="fw-bold mb-0">{{ auth()->user()->name }}</p>
                <p class="">{{ auth()->user()->email }}</p>
            </div>
            <div class="row-1">
                <a href="/seller/dashboard/profile/{{ auth()->user()->username }}/edit"><button class="btn btn-outline-primary">Edit Profile</button></a>
            </div>
        </div>
    </div>
    <!-- option section -->
    <div class="row mb-3 border-bottom border-secondary">
        <div class="col-1">
            <i class="fa-solid fa-house"></i>
        </div>
        <div class="col">
            <a href="/seller/dashboard" class="text-black" style="text-decoration: none;">
                <p>Daftar Kos / Kontrakan</p>
            </a>
        </div>
    </div>
    <div class="row mb-3 border-bottom border-secondary">
        <div class="col-1">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <div class="col">
            <a href="/seller/dashboard/orders" class="text-black" style="text-decoration: none;">
                <p>Permintaan Sewa</p>
            </a>
        </div>
    </div>
    <div class="row mb-3 border-bottom border-secondary">
        <div class="col-1">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <div class="col">
            <a href="/seller/dashboard/history" class="text-black" style="text-decoration: none;">
                <p>Riwayat Transaksi</p>
            </a>
        </div>
    </div>
    <div class="row mb-3 border-bottom border-secondary">
        <div class="col-1">
            <i class="fa-solid fa-pen-to-square"></i>
        </div>
        <div class="col">
            <a href="/seller/dashboard/change-password" class="text-black" style="text-decoration: none;"><p>Ganti Password</p></a>
        </div>
    </div>
</div>
