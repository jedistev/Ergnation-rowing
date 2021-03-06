<?php
use App\Http\Controllers\Common\ProfileController;
use App\Http\Controllers\League\LeagueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use \App\Http\Controllers\Athlete;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () { return view('home'); });


Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('register', [RegisterController::class,'register']);

Route::get('password/forget',  function () {
	return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function(){

    // profile routes
    // common for all users
    Route::group(['as' => 'common.'], function (){

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function (){
            Route::view('/','common.profile')->name('index');
            Route::post('/',[ProfileController::class, 'update'])->name('update');
        });

    });

    // League Routes
    Route::group(['middleware' => 'role:Super Admin|Athlete'], function (){
        Route::resource('league', LeagueController::class);
        Route::get('league/athletes/{league}', [LeagueController::class, 'athletes'])->name('league.athletes');
		Route::get('/teamlist', [App\Http\Controllers\JointableController::class, 'index']);
		Route::get('/teamlistfliter', [App\Http\Controllers\TeamUserListController::class, 'index']);
    });

	// League Routes for business owner
	Route::group(['middleware' => 'role:Super Admin|Business Owner|Athlete'], function (){
		Route::resource('league', LeagueController::class);
		Route::get('league/athletes/{league}', [LeagueController::class, 'athletes'])->name('league.athletes');
	});


	// League Routes for Individuals
	Route::group(['middleware' => 'role:Super Admin|Business Owner|Athlete|Individuals'], function (){
		Route::resource('league', LeagueController::class);
		Route::get('league/athletes/{league}', [LeagueController::class, 'athletes'])->name('league.athletes');
	});

    Route::group(['prefix' => 'athlete', 'middleware' => 'role:Athlete|Individuals', 'as' => 'athlete.'], function (){
        Route::get('/my-leagues', [Athlete\LeagueController::class, 'myLeagues'])->name('my-leagues');
        Route::get('/results/upload/{league}', [Athlete\ResultController::class, 'create'])->name('results.create');
        Route::post('/results/upload/{league}', [Athlete\ResultController::class, 'store'])->name('results.store');
        Route::get('/results/{league}', [Athlete\ResultController::class, 'show'])->name('results');
        Route::get('/leave/{league}', [Athlete\LeagueController::class, 'leave'])->name('league.leave');
    });



	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('/clear-cache', [HomeController::class,'clearCache']);

	// dashboard route
	Route::get('/dashboard', function () {
		return view('pages.dashboard');
	})->name('dashboard');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
	Route::get('/users', [UserController::class,'index']);
	Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	});

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);


	// permission examples
    Route::get('/permission-example', function () {
    	return view('permission-example');
    });
    // API Documentation
    Route::get('/rest-api', function () { return view('api'); });
    // Editable Datatable
	Route::get('/table-datatable-edit', function () {
		return view('pages.datatable-editable');
	});





	Route::get('/calendar', function () { return view('pages.calendar'); });
	Route::get('/charts-amcharts', function () { return view('pages.charts-amcharts'); });
	Route::get('/charts-chartist', function () { return view('pages.charts-chartist'); });
	Route::get('/charts-flot', function () { return view('pages.charts-flot'); });
	Route::get('/charts-knob', function () { return view('pages.charts-knob'); });
	Route::get('/forgot-password', function () { return view('pages.forgot-password'); });
	Route::get('/form-addon', function () { return view('pages.form-addon'); });
	Route::get('/form-advance', function () { return view('pages.form-advance'); });
	Route::get('/form-components', function () { return view('pages.form-components'); });
	Route::get('/form-picker', function () { return view('pages.form-picker'); });
	Route::get('/invoice', function () { return view('pages.invoice'); });
	Route::get('/layout-edit-item', function () { return view('pages.layout-edit-item'); });
	Route::get('/layouts', function () { return view('pages.layouts'); });

	Route::get('/navbar', function () { return view('pages.navbar'); });





	Route::get('/project', function () { return view('pages.project'); });
	Route::get('/view', function () { return view('pages.view'); });

	Route::get('/table-bootstrap', function () { return view('pages.table-bootstrap'); });
	Route::get('/table-datatable', function () { return view('pages.table-datatable'); });
	Route::get('/taskboard', function () { return view('pages.taskboard'); });
	Route::get('/widget-chart', function () { return view('pages.widget-chart'); });
	Route::get('/widget-data', function () { return view('pages.widget-data'); });
	Route::get('/widget-statistic', function () { return view('pages.widget-statistic'); });
	Route::get('/widgets', function () { return view('pages.widgets'); });

	// themekit ui pages
	Route::get('/alerts', function () { return view('pages.ui.alerts'); });
	Route::get('/badges', function () { return view('pages.ui.badges'); });
	Route::get('/buttons', function () { return view('pages.ui.buttons'); });
	Route::get('/cards', function () { return view('pages.ui.cards'); });
	Route::get('/carousel', function () { return view('pages.ui.carousel'); });
	Route::get('/icons', function () { return view('pages.ui.icons'); });
	Route::get('/modals', function () { return view('pages.ui.modals'); });
	Route::get('/navigation', function () { return view('pages.ui.navigation'); });
	Route::get('/notifications', function () { return view('pages.ui.notifications'); });
	Route::get('/range-slider', function () { return view('pages.ui.range-slider'); });
	Route::get('/rating', function () { return view('pages.ui.rating'); });
	Route::get('/session-timeout', function () { return view('pages.ui.session-timeout'); });
	Route::get('/pricing', function () { return view('pages.pricing'); });


	// new inventory routes
	Route::get('/pos', function () { return view('inventory.pos'); });
	Route::get('/products', function () { return view('inventory.product.list'); });
	Route::get('/products/create', function () { return view('inventory.product.create'); });
	Route::get('/categories', function () { return view('inventory.category.index'); });
	Route::get('/sales', function () { return view('inventory.sale.list'); });
	Route::get('/sales/create', function () { return view('inventory.sale.create'); });
	Route::get('/purchases', function () { return view('inventory.purchase.list'); });
	Route::get('/purchases/create', function () { return view('inventory.purchase.create'); });
	Route::get('/customers', function () { return view('inventory.people.customers'); });
	Route::get('/suppliers', function () { return view('inventory.people.suppliers'); });

});


Route::get('/register', function () { return view('pages.register'); });
Route::get('/login-1', function () { return view('pages.login'); });


/**
 * Teamwork routes
 */
Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function()
{
    Route::get('/', [App\Http\Controllers\Teamwork\TeamController::class, 'index'])->name('teams.index');
    Route::get('create', [App\Http\Controllers\Teamwork\TeamController::class, 'create'])->name('teams.create');
    Route::post('teams', [App\Http\Controllers\Teamwork\TeamController::class, 'store'])->name('teams.store');
    Route::get('edit/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'edit'])->name('teams.edit');
    Route::put('edit/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'update'])->name('teams.update');
    Route::delete('destroy/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'destroy'])->name('teams.destroy');
    Route::get('switch/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'switchTeam'])->name('teams.switch');
    Route::get('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'show'])->name('teams.members.show');
    Route::get('members/resend/{invite_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'resendInvite'])->name('teams.members.resend_invite');
    Route::post('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'invite'])->name('teams.members.invite');
    Route::delete('members/{id}/{user_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'destroy'])->name('teams.members.destroy');
    Route::get('accept/{token}', [App\Http\Controllers\Teamwork\AuthController::class, 'acceptInvite'])->name('teams.accept_invite');
});

 Route::get('league/leaderboard/{id}', [LeagueController::class, 'league_leaderboard'])->name('league.leaderboard');
 
// League Routes
    Route::group(['middleware' => 'role:Individuals'], function (){
        
    	Route::get('all/leagues/', [LeagueController::class, 'myleagues'])->name('leagues.myleagues');
        
        Route::get('open/leagues/', [LeagueController::class, 'openleagues'])->name('leagues.open');

        Route::get('my-registered-leagues/', [LeagueController::class, 'myregisteredleagues'])->name('leagues.myregistered');

        Route::get('join-league/', [LeagueController::class, 'joinLeague'])->name('leagues.joinLeague');

        Route::get('leave-league/', [LeagueController::class, 'LeaveLeague'])->name('leagues.LeaveLeague');

    });