<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MarketingLeaderController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\InitiativeController;
use App\Http\Controllers\TargetMarketController;
use App\Http\Controllers\SOWTController;
use App\Http\Controllers\StratergyAndTechnologyController;
use App\Http\Controllers\Website_Social_Controller;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\Prepared_byController;
use App\Http\Controllers\CompetitorController;
use App\Http\Controllers\E_SummaryController;

use App\Http\Controllers\Visibility_Plan_Controller;
use App\Http\Controllers\Engagedment_Plan_Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	// Route::get('billing', function () {
	// 	return view('billing');
	// })->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	// Route::get('rtl', function () {
	// 	return view('rtl');
	// })->name('rtl');

	// Route::get('user-management', function () {
	// 	return view('laravel-examples/user-management');
	// })->name('user-management');

	// Route::get('tables', function () {
	// 	return view('tables');
	// })->name('tables');

    // Route::get('virtual-reality', function () {
	// 	return view('virtual-reality');
	// })->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

	Route::get('companylist', function () {
		return view('pages.company.company');
	})->name('companylist');

});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');

Route::get('/companylist', [CompanyController::class, 'companylist'])->name('companylist');
Route::get('/addCompanyDetails', [CompanyController::class, 'addCompanyDetails'])->name('addCompanyDetails');
Route::post('/companyStore', [CompanyController::class, 'companyStore'])->name('companyStore');
Route::get('/addMarketingPlan/{id}', [CompanyController::class, 'addMarketingPlan'])->name('addMarketingPlan');
Route::get('/addBusinessPlan/{id}', [CompanyController::class, 'addBusinessPlan'])->name('addBusinessPlan');
Route::get('/Delete_Company/{id}', [CompanyController::class, 'Delete_Company'])->name('Delete_Company');


Route::get('/Edit_Business_Plan/{id}', [CompanyController::class, 'Edit_Business_Plan'])->name('Edit_Business_Plan');
Route::post('/Update_Business_Plan', [CompanyController::class, 'Update_Business_Plan'])->name('Update_Business_Plan');
Route::get('/Edit_Marketing_Plan/{id}', [CompanyController::class, 'Edit_Marketing_Plan'])->name('Edit_Marketing_Plan');
Route::post('/Update_Marketing_Plan', [CompanyController::class, 'Update_Marketing_Plan'])->name('Update_Marketing_Plan');


Route::post('/storeMarketingLeaders', [MarketingLeaderController::class, 'storeMarketingLeaders'])->name('storeMarketingLeaders');
Route::post('/UpdateMarketLeader', [MarketingLeaderController::class, 'UpdateMarketLeader'])->name('UpdateMarketLeader');
Route::post('/delete_added_market_leader/{id}', [MarketingLeaderController::class, 'delete_added_market_leader'])->name('delete_added_market_leader');


Route::post('/storeBusinessDetails', [BusinessController::class, 'storeBusinessDetails'])->name('storeBusinessDetails');

Route::post('/storeAuthorDetails', [AuthorController::class, 'storeAuthorDetails'])->name('storeAuthorDetails');
Route::post('/updateAuthors', [AuthorController::class, 'updateAuthors'])->name('updateAuthors');
Route::post('/delete_added_author/{id}', [AuthorController::class, 'delete_added_author'])->name('delete_added_author');


Route::post('/storeInitiativeDetails', [InitiativeController::class, 'storeInitiativeDetails'])->name('storeInitiativeDetails');
Route::post('/UpdateInitiativeDetails', [InitiativeController::class, 'UpdateInitiativeDetails'])->name('UpdateInitiativeDetails');
Route::post('/delete_added_initiative/{id}', [InitiativeController::class, 'delete_added_initiative'])->name('delete_added_initiative');


Route::post('/storeIndustryDetails', [TargetMarketController::class, 'storeIndustryDetails'])->name('storeIndustryDetails');
Route::post('/UpdateIndustryDetails', [TargetMarketController::class, 'UpdateIndustryDetails'])->name('UpdateIndustryDetails');
Route::post('/delete_added_industry/{id}', [TargetMarketController::class, 'delete_added_industry'])->name('delete_added_industry');


Route::post('/storePersonaDetails', [TargetMarketController::class, 'storePersonaDetails'])->name('storePersonaDetails');
Route::post('/UpdatePersonaDetails', [TargetMarketController::class, 'UpdatePersonaDetails'])->name('UpdatePersonaDetails');
Route::post('/delete_added_pearsona/{id}', [TargetMarketController::class, 'delete_added_pearsona'])->name('delete_added_pearsona');

Route::post('/storeCompetitiveDetails', [TargetMarketController::class, 'storeCompetitiveDetails'])->name('storeCompetitiveDetails');
Route::post('/UpdateCompetitiveDetails', [TargetMarketController::class, 'UpdateCompetitiveDetails'])->name('UpdateCompetitiveDetails');
Route::post('/delete_added_competitive/{id}', [TargetMarketController::class, 'delete_added_competitive'])->name('delete_added_competitive');


Route::post('/storeStrength', [SOWTController::class, 'storeStrength'])->name('storeStrength');
Route::post('/Updatestrength', [SOWTController::class, 'Updatestrength'])->name('Updatestrength');
Route::post('/delete_added_strength/{id}', [SOWTController::class, 'delete_added_strength'])->name('delete_added_strength');

Route::post('/storeWeak', [SOWTController::class, 'storeWeak'])->name('storeWeak');
Route::post('/UpdateWeak', [SOWTController::class, 'UpdateWeak'])->name('UpdateWeak');
Route::post('/delete_added_weak/{id}', [SOWTController::class, 'delete_added_weak'])->name('delete_added_weak');


Route::post('/storeOppotunity', [SOWTController::class, 'storeOppotunity'])->name('storeOppotunity');
Route::post('/UpdateOppotunity', [SOWTController::class, 'UpdateOppotunity'])->name('UpdateOppotunity');
Route::post('/delete_added_oppoyunity/{id}', [SOWTController::class, 'delete_added_oppoyunity'])->name('delete_added_oppoyunity');


Route::post('/storeThreat', [SOWTController::class, 'storeThreat'])->name('storeThreat');
Route::post('/UpdateThreat', [SOWTController::class, 'UpdateThreat'])->name('UpdateThreat');
Route::post('/delete_added_threat/{id}', [SOWTController::class, 'delete_added_threat'])->name('delete_added_threat');


Route::post('/storeStratergyAndTechnology', [StratergyAndTechnologyController::class, 'storeStratergyAndTechnology'])->name('storeStratergyAndTechnology');
Route::post('/storeWebsiteDetails', [Website_Social_Controller::class, 'storeWebsiteDetails'])->name('storeWebsiteDetails');
Route::post('/UpdateWebsiteDetails', [Website_Social_Controller::class, 'UpdateWebsiteDetails'])->name('UpdateWebsiteDetails');

Route::post('/storeNetworkDetails', [Website_Social_Controller::class, 'storeNetworkDetails'])->name('storeNetworkDetails');
Route::post('/UpdateNetworkDetails', [Website_Social_Controller::class, 'UpdateNetworkDetails'])->name('UpdateNetworkDetails');
Route::post('/delete_added_website/{id}', [Website_Social_Controller::class, 'delete_added_website'])->name('delete_added_website');
Route::post('/delete_added_network/{id}', [Website_Social_Controller::class, 'delete_added_network'])->name('delete_added_network');


Route::post('/storeBudget', [BudgetController::class, 'storeBudget'])->name('storeBudget');
Route::post('/updateBudget', [BudgetController::class, 'updateBudget'])->name('updateBudget');

Route::post('/storePreparedBy', [Prepared_byController::class, 'storePreparedBy'])->name('storePreparedBy');
Route::post('/UpdatePreparedBy', [Prepared_byController::class, 'UpdatePreparedBy'])->name('UpdatePreparedBy');
Route::post('/delete_added_prepared_by/{id}', [Prepared_byController::class, 'delete_added_prepared_by'])->name('delete_added_prepared_by');


Route::post('/storeCompetitor', [CompetitorController::class, 'storeCompetitor'])->name('storeCompetitor');
Route::post('/UpdateCompetitor', [CompetitorController::class, 'UpdateCompetitor'])->name('UpdateCompetitor');
Route::post('/delete_added_competitor/{id}', [CompetitorController::class, 'delete_added_competitor'])->name('delete_added_competitor');

Route::post('/storeSummary', [E_SummaryController::class, 'storeSummary'])->name('storeSummary');
Route::post('/UpdateSummary', [E_SummaryController::class, 'UpdateSummary'])->name('UpdateSummary');


// Routes for spreadsheet plans
Route::get('/visibility_plan', [Visibility_Plan_Controller::class, 'visibility_plan'])->name('visibility_plan');
Route::post('/Store_Touchpoint', [Visibility_Plan_Controller::class, 'Store_Touchpoint'])->name('Store_Touchpoint');
Route::get('/Add_visibility_Plan_Details/{id}', [Visibility_Plan_Controller::class, 'Add_visibility_Plan_Details'])->name('Add_visibility_Plan_Details');
Route::post('/Store_Visibility_Plan', [Visibility_Plan_Controller::class, 'Store_Visibility_Plan'])->name('Store_Visibility_Plan');
Route::post('/set_end_date', [Visibility_Plan_Controller::class, 'set_end_date'])->name('set_end_date');
Route::post('/Store_Parent_Visibility_Plan', [Visibility_Plan_Controller::class, 'Store_Parent_Visibility_Plan'])->name('Store_Parent_Visibility_Plan');
Route::get('/Update_visibility_Plan_Details/{id}', [Visibility_Plan_Controller::class, 'Update_visibility_Plan_Details'])->name('Update_visibility_Plan_Details');
Route::post('/Update_touchpoint_name', [Visibility_Plan_Controller::class, 'Update_touchpoint_name'])->name('Update_touchpoint_name');
Route::post('/submit', [Visibility_Plan_Controller::class, 'submit'])->name('submit');
Route::post('/Update_visibility_details', [Visibility_Plan_Controller::class, 'Update_visibility_details'])->name('Update_visibility_details');


Route::get('/Engagedment_plan', [Engagedment_Plan_Controller::class, 'Engagedment_plan'])->name('Engagedment_plan');
Route::post('/Store_Engagedment_Touchpoint', [Engagedment_Plan_Controller::class, 'Store_Engagedment_Touchpoint'])->name('Store_Engagedment_Touchpoint');
Route::get('/Add_Engagedment_Plan_Details/{id}', [Engagedment_Plan_Controller::class, 'Add_Engagedment_Plan_Details'])->name('Add_Engagedment_Plan_Details');
Route::post('/Store_Engagement_Plan', [Engagedment_Plan_Controller::class, 'Store_Engagement_Plan'])->name('Store_Engagement_Plan');

Route::post('/engagement_start', [Engagedment_Plan_Controller::class, 'engagement_start'])->name('engagement_start');
Route::post('/engagement_end', [Engagedment_Plan_Controller::class, 'engagement_end'])->name('engagement_end');
Route::post('/engagement_submit', [Engagedment_Plan_Controller::class, 'engagement_submit'])->name('engagement_submit');

Route::get('/Update_Engagement_Plan_Details/{id}', [Engagedment_Plan_Controller::class, 'Update_Engagement_Plan_Details'])->name('Update_Engagement_Plan_Details');
Route::post('/Update_engagement_details', [Engagedment_Plan_Controller::class, 'Update_engagement_details'])->name('Update_engagement_details');

Route::get('/View_Vsibility_Plan/{id}', [Visibility_Plan_Controller::class, 'View_Vsibility_Plan'])->name('View_Vsibility_Plan');
Route::get('/View_Engagement_Plan/{id}', [Engagedment_Plan_Controller::class, 'View_Engagement_Plan'])->name('View_Engagement_Plan');

