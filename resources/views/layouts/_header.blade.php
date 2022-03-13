<header class="header_css">
			<figure>
				<a href="{{ route('home1') }}"><img src="{{ asset('images/logo.png') }}" alt="logo" class="logo"></a>
			</figure>

    @if(Route::current()->uri != 'contatti' && Route::current()->uri != 'faq')
	@guest
    <div class="btn_nav">
				<button class="lgn_btn" onclick="window.location='{{route('login')}}'" type="button" name="button">Accedi/Registrati</button>
			</div>
    @endguest
    @auth
        <div class="btn_nav">
            <button class="lgn_btn"  type="button" name="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    @can('isAdmin')
        @if(Route::current()->uri != 'admin')
            <div class="btn_nav">
                <button class="lgn_btn"  type="button" name="button" onclick="window.location='{{route('admin')}}'">Area Admin</button>
            </div>
        @endif
        @if(Route::current()->uri == 'admin')
            <div class="btn_nav">
                <button class="lgn_btn"  type="button" name="button" onclick="window.location='{{route('home1')}}'">Home</button>
            </div>
        @endif
    @endcan
    @can('isUser')
    @if(Route::current()->uri != 'user')
        <div class="btn_nav">
            <button class="lgn_btn"  type="button" name="button" onclick="window.location='{{route('user_area')}}'">Area Personale</button>
        </div>
    @endif
    @endcan
		@can('isOrg')
		@if(Route::current()->uri != 'org')
	     	<div class="btn_nav">
			    	<button class="lgn_btn"  type="button" name="button" onclick="window.location='{{route('org_area')}}'">Area Organizzatori</button>
		    </div>
		@endif
		@endcan
    @endauth
    @else
    @endif

</header>
