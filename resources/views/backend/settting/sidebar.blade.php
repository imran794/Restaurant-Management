 <div class="list-group">
     <a href="{{ route('app.setting.general') }}" class="list-group-item list-group-item-action {{ Route::is('app.setting.general') ? 'active' : '' }}">General</a>
     <a href="{{ route('app.setting.apearance') }}" class="list-group-item list-group-item-action {{ Route::is('app.setting.apearance') ? 'active' : '' }}">Apearance</a>
     <a href="{{ route('app.setting.mail') }}" class="list-group-item list-group-item-action {{ Route::is('app.setting.mail') ? 'active' : '' }}">Mail</a>
     <a href="{{ route('app.setting.socialite') }}" class="list-group-item list-group-item-action {{ Route::is('app.setting.socialite') ? 'active' : '' }}">Socialite Login</a>

 </div>
