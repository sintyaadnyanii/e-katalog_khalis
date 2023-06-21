<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            @foreach (getBreadcrumbs() as $breadcrumb)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['label'] }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
                @endif
                {{-- <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li> --}}
                {{-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> --}}
            @endforeach

        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8 ml-auto">
        {{-- <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button"
            aria-expanded="false" data-tw-toggle="dropdown">
            <img alt="User Profile"
                src="{{ asset(isset(auth()->user()->image->src) ? 'storage/' . auth()->user()->image->src : 'dist/images/profile-14.jpg') }}">
        </div> --}}
        <div role="button" class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in"
            aria-expanded="false" data-tw-toggle="dropdown">
            <img alt="User Profile"
                src="{{ asset(isset(auth()->user()->image->src) ? 'storage/' . auth()->user()->image->thumb : 'dist/images/profile-14.jpg') }}">
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">
                <li class="p-2">
                    <div class="font-medium">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs text-white/70 mt-0.5">{{ auth()->user()->level ?? 'Administrator' }}</div>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="{{ route('profile.update') }}" class="dropdown-item hover:bg-white/5"> <i
                            data-lucide="user" class="w-4 h-4 mr-2"></i> Edit Profile </a>
                </li>
                <li>
                    <a href="{{ route('password.update') }}" class="dropdown-item hover:bg-white/5"> <i
                            data-lucide="lock" class="w-4 h-4 mr-2"></i> Change Password </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5"> <i
                            data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
