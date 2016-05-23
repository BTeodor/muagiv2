<?php

Route::group(['middleware' => 'web'], function () {
	Route::get('login', ['as' => 'user.getLogin', 'uses' => 'WebUser\UserController@getLogin']);
	Route::post('login', 'WebUser\UserController@postLogin');

	Route::get('logout', [
		'as' => 'auth.logout',
		'uses' => 'Auth\AuthController@getLogout',
	]);

	if (settings('reg_enabled')) {
		Route::get('register', 'Auth\AuthController@getRegister');
		Route::post('register', 'Auth\AuthController@postRegister');
		Route::get('register/confirmation/{token}', [
			'as' => 'register.confirm-email',
			'uses' => 'Auth\AuthController@confirmEmail',
		]);
	}

	if (settings('forgot_password')) {
		Route::get('password/remind', 'Auth\PasswordController@forgotPassword');
		Route::post('password/remind', 'Auth\PasswordController@sendPasswordReminder');
		Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
		Route::post('password/reset', 'Auth\PasswordController@postReset');
	}

	if (settings('2fa.enabled')) {
		Route::get('auth/two-factor-authentication', [
			'as' => 'auth.token',
			'uses' => 'Auth\AuthController@getToken',
		]);

		Route::post('auth/two-factor-authentication', [
			'as' => 'auth.token.validate',
			'uses' => 'Auth\AuthController@postToken',
		]);
	}

	Route::get('auth/{provider}/login', [
		'as' => 'social.login',
		'uses' => 'Auth\SocialAuthController@redirectToProvider',
		'middleware' => 'social.login',
	]);

	Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

	Route::get('auth/twitter/email', 'Auth\SocialAuthController@getTwitterEmail');
	Route::post('auth/twitter/email', 'Auth\SocialAuthController@postTwitterEmail');

});

Route::group(['middleware' => 'web'], function () {
	Route::localizedGroup(function () {

		Route::get('/', 'Frontend\HomeController@home')->name('frontend.index');
		Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function () {
			Route::get('/', [
				'as' => 'dashboard',
				'uses' => 'DashboardController@index',
			]);

			Route::group(['prefix' => 'channel'], function() {
				Route::get('test', function(){
					$user = \Auth::user();
					// $channel = $user->channel()->get()->toArray() [0];
					var_dump(json_encode($user->channel()));//->first()));
				});
				Route::get('index', ['as' => 'channel.index', 'uses' => 'ChannelController@index']);

				Route::put('details/update', [
					'as' => 'channel.details.update',
					'uses' => 'ChannelController@updateDetails'
				]);

				Route::post('details/create', [
					'as' => 'channel.details.create',
					'uses' => 'ChannelController@createDetails'
				]);

				Route::post('avatar/update', [
					'as' => 'channel.avatar.update',
					'uses' => 'ChannelController@updateChannelAvatar'
				]);

				Route::get('event/index', [
					'as' => 'channel.event.index',
					'uses' => 'ChannelController@indexEvent'
				]);

				Route::put('event/update', [
					'as' => 'channel.event.update',
					'uses' => 'ChannelController@updateEvent'
				]);

				Route::post('event/create', [
					'as' => 'channel.event.create',
					'uses' => 'ChannelController@createEvent'
				]);

				Route::post('event/poster/update', [
					'as' => 'channel.event.updatePoster',
					'uses' => 'ChannelController@updatePoster'
				]);

				Route::post('event/delete', [
					'as' => 'channel.event.delete',
					'uses' => 'ChannelController@deleteEvent'
				]);

				Route::get('product/index', [
					'as' => 'channel.product.index',
					'uses' => 'ChannelController@indexProduct'
				]);

				Route::get('product/{id}/show', [
					'as' => 'channel.product.show',
					'uses' => 'ChannelController@showProduct'
				]);

				Route::get('product/{id}/edit', [
					'as' => 'channel.product.edit',
					'uses' => 'ChannelController@editProduct'
				]);

				Route::put('product/update', [
					'as' => 'channel.product.update',
					'uses' => 'ChannelController@updateProduct'
				]);

				Route::get('product/create', [
					'as' => 'channel.product.create',
					'uses' => 'ChannelController@createProduct'
				]);
				Route::post('product/create', [
					'as' => 'channel.product.store',
					'uses' => 'ChannelController@storeProduct'
				]);

				Route::delete('product/{id}/delete', [
					'as' => 'channel.product.delete',
					'uses' => 'ChannelController@deleteProduct'
				]);

				Route::delete('product/{id}/restore', [
					'as' => 'channel.product.restore',
					'uses' => 'ChannelController@restoreProduct'
				]);

				Route::get('schedule/index', [
					'as' => 'channel.schedule.index',
					'uses' => 'ChannelController@indexSchedule'
				]);

				Route::get('schedule/{product_id}/create', [
					'as' => 'channel.schedule.create',
					'uses' => 'ChannelController@createSchedule'
				]);

				Route::post('schedule/store', [
					'as' =>'channel.schedule.store',
					'uses' => 'ChannelController@storeSchedule'
				]);

				Route::get('schedule/{schedule_id}/edit', [
					'as' => 'channel.schedule.edit',
					'uses' => 'ChannelController@editSchedule'
				]);

				Route::put('schedule/edit', [
					'as' => 'channel.schedule.update',
					'uses' => 'ChannelController@updateSchedule'
				]);

				Route::delete('schedule/{id}/delete', [
					'as' => 'channel.schedule.delete', 
					'uses' => 'ChannelController@deleteSchedule'
				]);
			});

			Route::get('profile', [
				'as' => 'profile',
				'uses' => 'ProfileController@index',
			]);

			Route::get('profile/activity', [
				'as' => 'profile.activity',
				'uses' => 'ProfileController@activity',
			]);

			Route::put('profile/details/update', [
				'as' => 'profile.update.details',
				'uses' => 'ProfileController@updateDetails',
			]);

			Route::post('profile/avatar/update', [
				'as' => 'profile.update.avatar',
				'uses' => 'ProfileController@updateAvatar',
			]);

			Route::post('profile/avatar/update/external', [
				'as' => 'profile.update.avatar-external',
				'uses' => 'ProfileController@updateAvatarExternal',
			]);

			Route::put('profile/login-details/update', [
				'as' => 'profile.update.login-details',
				'uses' => 'ProfileController@updateLoginDetails',
			]);

			Route::put('profile/social-networks/update', [
				'as' => 'profile.update.social-networks',
				'uses' => 'ProfileController@updateSocialNetworks',
			]);

			Route::post('profile/two-factor/enable', [
				'as' => 'profile.two-factor.enable',
				'uses' => 'ProfileController@enableTwoFactorAuth',
			]);

			Route::post('profile/two-factor/disable', [
				'as' => 'profile.two-factor.disable',
				'uses' => 'ProfileController@disableTwoFactorAuth',
			]);

			Route::get('profile/sessions', [
				'as' => 'profile.sessions',
				'uses' => 'ProfileController@sessions',
			]);

			Route::delete('profile/sessions/{session}/invalidate', [
				'as' => 'profile.sessions.invalidate',
				'uses' => 'ProfileController@invalidateSession',
			]);

			Route::get('category', [
				'as' => 'category.list',
				'uses' => 'CategoryController@index'
			]);

			Route::get('category/create', [
				'as' => 'category.create',
				'uses' => 'CategoryController@create'
			]);

			Route::post('category/store', [
				'as' => 'category.store',
				'uses' => 'CategoryController@store'
			]);

			Route::get('category/{id}/edit', [
				'as' => 'category.edit',
				'uses' => 'CategoryController@edit'
			]);

			Route::delete('category/{id}/delete', [
				'as' => 'category.delete',
				'uses' => 'CategoryController@delete'
			]);

			Route::put('category/edit', [
				'as' => 'category.update',
				'uses' => 'CategoryController@update'
			]);

			Route::group(['prefix' => 'adminchannel'], function(){
				Route::get('channel', [
					'as' => 'adminchannel.channel.list',
					'uses' => 'AdminChannel\ChannelController@index'
				]);

				Route::get('channel/{id}/edit', [
					'as' => 'adminchannel.channel.edit',
					'uses' => 'AdminChannel\ChannelController@edit'
				]);

				Route::delete('channel/{id}/delete', [
					'as' => 'adminchannel.channel.delete',
					'uses' => 'AdminChannel\ChannelController@delete'
				]);

				Route::put('channel/edit', [
					'as' => 'adminchannel.channel.update',
					'uses' => 'AdminChannel\ChannelController@update'
				]);
			});

			Route::get('user', [
				'as' => 'user.list',
				'uses' => 'UsersController@index',
			]);

			Route::get('user/create', [
				'as' => 'user.create',
				'uses' => 'UsersController@create',
			]);

			Route::post('user/create', [
				'as' => 'user.store',
				'uses' => 'UsersController@store',
			]);

			Route::get('user/{user}/show', [
				'as' => 'user.show',
				'uses' => 'UsersController@view',
			]);

			Route::get('user/{user}/edit', [
				'as' => 'user.edit',
				'uses' => 'UsersController@edit',
			]);

			Route::put('user/{user}/update/details', [
				'as' => 'user.update.details',
				'uses' => 'UsersController@updateDetails',
			]);

			Route::put('user/{user}/update/login-details', [
				'as' => 'user.update.login-details',
				'uses' => 'UsersController@updateLoginDetails',
			]);

			Route::delete('user/{user}/delete', [
				'as' => 'user.delete',
				'uses' => 'UsersController@delete',
			]);

			Route::post('user/{user}/update/avatar', [
				'as' => 'user.update.avatar',
				'uses' => 'UsersController@updateAvatar',
			]);

			Route::post('user/{user}/update/avatar/external', [
				'as' => 'user.update.avatar.external',
				'uses' => 'UsersController@updateAvatarExternal',
			]);

			Route::post('user/{user}/update/social-networks', [
				'as' => 'user.update.socials',
				'uses' => 'UsersController@updateSocialNetworks',
			]);

			Route::get('user/{user}/sessions', [
				'as' => 'user.sessions',
				'uses' => 'UsersController@sessions',
			]);

			Route::delete('user/{user}/sessions/{session}/invalidate', [
				'as' => 'user.sessions.invalidate',
				'uses' => 'UsersController@invalidateSession',
			]);

			Route::post('user/{user}/two-factor/enable', [
				'as' => 'user.two-factor.enable',
				'uses' => 'UsersController@enableTwoFactorAuth',
			]);

			Route::post('user/{user}/two-factor/disable', [
				'as' => 'user.two-factor.disable',
				'uses' => 'UsersController@disableTwoFactorAuth',
			]);

			Route::get('role', [
				'as' => 'role.index',
				'uses' => 'RolesController@index',
			]);

			Route::get('role/create', [
				'as' => 'role.create',
				'uses' => 'RolesController@create',
			]);

			Route::post('role/store', [
				'as' => 'role.store',
				'uses' => 'RolesController@store',
			]);

			Route::get('role/{role}/edit', [
				'as' => 'role.edit',
				'uses' => 'RolesController@edit',
			]);

			Route::put('role/{role}/update', [
				'as' => 'role.update',
				'uses' => 'RolesController@update',
			]);

			Route::delete('role/{role}/delete', [
				'as' => 'role.delete',
				'uses' => 'RolesController@delete',
			]);

			Route::post('permission/save', [
				'as' => 'dashboard.permission.save',
				'uses' => 'PermissionsController@saveRolePermissions',
			]);

			Route::resource('permission', 'PermissionsController');

			Route::get('settings', [
				'as' => 'settings.general',
				'uses' => 'SettingsController@general',
				'middleware' => 'permission:settings.general',
			]);

			Route::post('settings/general', [
				'as' => 'settings.general.update',
				'uses' => 'SettingsController@update',
				'middleware' => 'permission:settings.general',
			]);

			Route::get('settings/auth', [
				'as' => 'settings.auth',
				'uses' => 'SettingsController@auth',
				'middleware' => 'permission:settings.auth',
			]);

			Route::post('settings/auth', [
				'as' => 'settings.auth.update',
				'uses' => 'SettingsController@update',
				'middleware' => 'permission:settings.auth',
			]);

			if (env('AUTHY_KEY')) {
				Route::post('settings/auth/2fa/enable', [
					'as' => 'settings.auth.2fa.enable',
					'uses' => 'SettingsController@enableTwoFactor',
					'middleware' => 'permission:settings.auth',
				]);

				Route::post('settings/auth/2fa/disable', [
					'as' => 'settings.auth.2fa.disable',
					'uses' => 'SettingsController@disableTwoFactor',
					'middleware' => 'permission:settings.auth',
				]);
			}

			Route::post('settings/auth/registration/captcha/enable', [
				'as' => 'settings.registration.captcha.enable',
				'uses' => 'SettingsController@enableCaptcha',
				'middleware' => 'permission:settings.auth',
			]);

			Route::post('settings/auth/registration/captcha/disable', [
				'as' => 'settings.registration.captcha.disable',
				'uses' => 'SettingsController@disableCaptcha',
				'middleware' => 'permission:settings.auth',
			]);

			Route::get('settings/notifications', [
				'as' => 'settings.notifications',
				'uses' => 'SettingsController@notifications',
				'middleware' => 'permission:settings.notifications',
			]);

			Route::post('settings/notifications', [
				'as' => 'settings.notifications.update',
				'uses' => 'SettingsController@update',
				'middleware' => 'permission:settings.notifications',
			]);

			Route::get('activity', [
				'as' => 'activity.index',
				'uses' => 'ActivityController@index',
			]);

			Route::get('activity/user/{user}/log', [
				'as' => 'activity.user',
				'uses' => 'ActivityController@userActivity',
			]);

			Route::group([
				'prefix' => 'log-viewer',
				'middleware' => 'role:Admin',
			], function () {
				Route::get('/', [
					'as' => 'log-viewer::dashboard',
					'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index',
				]);
				Route::group([
					'prefix' => 'logs',
				], function () {
					Route::get('/', [
						'as' => 'log-viewer::logs.list',
						'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs',
					]);
					Route::delete('delete', [
						'as' => 'log-viewer::logs.delete',
						'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete',
					]);
				});
				Route::group([
					'prefix' => '{date}',
				], function () {
					Route::get('/', [
						'as' => 'log-viewer::logs.show',
						'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show',
					]);
					Route::get('download', [
						'as' => 'log-viewer::logs.download',
						'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download',
					]);
					Route::get('{level}', [
						'as' => 'log-viewer::logs.filter',
						'uses' => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel',
					]);
				});
			});
		});
	});

});


Route::get('/', ['as' => '/', function(){
	return view('homepage');
}]);

Route::group(['prefix' => 'api/v1'], function(){
	Route::get('products', function (){
		$clock = new App\ExternalClasses\MyClock();
		$today = $clock->get_today_date_GMT_7("Y-m-d");
		return Response::json(App\Products::where('start_date', $today)->get());

	});

	Route::get('channels', function(){
		return Response::json(App\Channels::all());
	});

	Route::get('broadcast', function(){
		$clock = new App\ExternalClasses\MyClock();
		$today = $clock->get_today_date_GMT_7("Y-m-d");
		$current_time_hh_mm_GMT_7 = $clock->get_current_time_GMT_7("H:i");
		$current_unix_time_UTC = $clock->get_unix_time_UTC_from_GMT_7($current_time_hh_mm_GMT_7, $today);
		// $pattern = $today.'%';
		$products = App\Products::where('start_date', $today)->orderBy('start_time', 'asc')->get();
		$array = array();

		function item_type($start_time, $end_time, $current_time){
			if ($current_time < $start_time) {
				return 1;
			}
			elseif ($current_time >= $start_time && $current_time <= $end_time) {
				return 0;
			}
			else return -1;
		}
		foreach ($products as $product) {
			if (($item_type = item_type($product->start_time, $product->end_time, $current_unix_time_UTC)) != -1) {
				array_push($array, new App\ExternalClasses\NoDesItem($product, $item_type));
			}
		}

		return Response::json($array);
	});

	Route::get('product/detail/{id}/', function($id){
    	$product = App\Products::find($id);
    	if(empty($product)) return Response::json(["status" => 404, "description" => "<p>Not Found</p>"]);
    	else return Response::json(["status" => 200, "description" => $product->description]);
	});
});

Route::group(['middleware' => 'web'], function(){

	Route::group(['prefix' => 'api/v2'], function(){

		Route::post('login', [
			'as' => 'user.login',
			'uses' => 'Api\v2\MobileAuthController@postLogin'
		]);

		Route::post('register', function(Illuminate\Http\Request $request){
			if (!$request->has('email') || !$request->has('username') || !$request->has('password')) {
	            return response()->json([
	                'status' => false,
	                'data' => ['message' => "Email, username or password is empty"]
	            ]);
			}
			$status = "Active";
			$credentials = ['email' => $request->email, 'username' => $request->username, 'password' => bcrypt($request->password), 'status' => $status];

	        try {
				$id = DB::table('users')->insertGetId($credentials);
	        } catch (\Illuminate\Database\QueryException $e){
	            return response()->json([
	                'status' => false,
	                'data' => [
	                    'code' => $e->getCode(),
	                    'message' => $e->errorInfo[2]
	                ]
	            ], 500);
	        }
	        $user = App\User::find($id);

	        $user->role()->attach(App\Role::findByName('User'));

            return response()->json([
                'status' => true,
                'data' => ['user' => $user]
            ]);
		});

		Route::post('searchByProductName', [
			'as' => 'product.search',
			'uses' => 'Api\v2\ProductController@searchByProductName'
		]);

		Route::post('favorite/create', [
			'as' => 'favorite.create',
			'uses' => 'Api\v2\FavoriteController@create'
		]);

		Route::post('favorite/delete', [
			'as' => 'favorite.delete',
			'uses' => 'Api\v2\FavoriteController@delete'
		]);

		Route::post('favorite/list', [
			'as' => 'favorite.list',
			'uses' => 'Api\v2\FavoriteController@index'
		]);

		Route::post('recent/create', [
			'as' => 'recent.create',
			'uses' => 'Api\v2\RecentController@create'
		]);

		Route::post('recent/delete', [
			'as' => 'recent.delete',
			'uses' => 'Api\v2\RecentController@delete'
		]);

		Route::post('recent/list', [
			'as' => 'recent.list',
			'uses' => 'Api\v2\RecentController@index'
		]);

		Route::post('channel/event', 'Api\v2\EventController@listByChannelId');

		Route::post('event/find', 'Api\v2\EventController@findEventById');

		Route::get('event/index', 'Api\v2\EventController@index');

		Route::post('event/product', [
			'as' => 'channel.event.listProducts',
			'uses' => 'Api\v2\EventController@listProducts'
		]);

		Route::get('category', 'Api\v2\CategoryController@index');
		Route::get('category/{id}', 'Api\v2\CategoryController@indexProduct');
		Route::get('category/{id}/onair', 'Api\v2\CategoryController@indexOnAirProduct');

		Route::get('cron/scj', 'CronController@run');
		Route::get('broadcast', 'Api\v2\ScheduleController@index');

		Route::get('livetoday', 'Api\v2\ScheduleController@indexAll');

		Route::get('keyword', 'Api\v2\KeywordController@index');
		Route::get('keyword/autocomplete', 'Api\v2\KeywordController@autocomplete');
		Route::post('compare', 'Api\v2\ProductController@compare');

		Route::get('hot', 'Api\v2\ProductController@hotItem');
	});

});

Route::group(['middleware' => 'web'], function(){
	Route::group(['prefix' => 'auth'], function(){
		Route::get('login', 'WebUser\UserController@getLogin');

		Route::get('register', 'WebUser\UserController@getRegister');

		Route::post('register', 'WebUser\UserController@postRegister');

		Route::post('login', 'WebUser\UserController@postLogin');
	});
});

Route::get('product/{id}', 'Api\v2\ProductController@showProduct');
