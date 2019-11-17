<?php

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

// Route::get('/', function () {
//     // return view('auth.login');
//     return view('website.dashboard');
// });

Route::any('showForgetPassword', [
	'as'=>'showForgetPassword',
	'uses'=>'Auth\ResetPasswordController@showForgetPassword'
]);

Route::any('showResetPassword', [
	'as'=>'showResetPassword',
	'uses'=>'Auth\ResetPasswordController@showResetPassword'
]);

Route::any('/', [
	'as'=>'showDashboard',
	'uses'=>'HomeController@showDashboard'
]);


Route::any('showAboutUs', [
	'as'=>'showAboutUs',
	'uses'=>'HomeController@showAboutUs'
]);

Route::any('showPrivacyPolicy', [
	'as'=>'showPrivacyPolicy',
	'uses'=>'HomeController@showPrivacyPolicy'
]);

Route::any('showTermsAndConditions', [
	'as'=>'showTermsAndConditions',
	'uses'=>'HomeController@showTermsAndConditions'
]);

Route::any('showLiveHelp', [
	'as'=>'showLiveHelp',
	'uses'=>'HomeController@showLiveHelp'
]);

Route::any('showFeedback', [
	'as'=>'showFeedback',
	'uses'=>'HomeController@showFeedback'
]);

Route::any('showFAQs', [
	'as'=>'showFAQs',
	'uses'=>'HomeController@showFAQs'
]);

Route::any('showServices', [
	'as'=>'showServices',
	'uses'=>'HomeController@showServices'
]);

Route::any('showAgentMenu', [
	'as'=>'showAgentMenu',
	'uses'=>'HomeController@showAgentMenu'
]);

Route::any('showContact', [
	'as'=>'showContact',
	'uses'=>'HomeController@showContact'
]);


Route::any('createRegister', [
	'as'=>'createRegister',
	'uses'=>'Auth\LoginController@createRegister'
]);


Route::any('showPaymentMethod', [
	'as'=>'showPaymentMethod',
	'uses'=>'HomeController@showPaymentMethod'
]);


Route::any('showlogin', [
	'as'=>'showlogin',
	'uses'=>'Auth\LoginController@showlogin'
]);


Route::any('favoriteSomeone/{id}', [
	'as'=>'favoriteSomeone',
	'uses'=>'HomeController@favoriteSomeone'
]);

Route::any('sendProposal/{id}', [
	'as'=>'sendProposal',
	'uses'=>'HomeController@sendProposal'
]);

Route::any('showProfileDetails/{id}', [
	'as'=>'showProfileDetails',
	'uses'=>'HomeController@showProfileDetails'
]);

Route::any('showAgentProfiles/{id}', [
	'as'=>'showAgentProfiles',
	'uses'=>'HomeController@showAgentProfiles'
]);


Route::any('showAdvanceSearch', [
	'as'=>'showAdvanceSearch',
	'uses'=>'HomeController@showAdvanceSearch'
]);


Route::any('showByGender', [
	'as'=>'showByGender',
	'uses'=>'HomeController@showByGender'
]);


Route::any('showByAge', [
	'as'=>'showByAge',
	'uses'=>'HomeController@showByAge'
]);


Route::any('showByMarital', [
	'as'=>'showByMarital',
	'uses'=>'HomeController@showByMarital'
]);


Route::any('showByReligion', [
	'as'=>'showByReligion',
	'uses'=>'HomeController@showByReligion'
]);


Route::any('showByEducation', [
	'as'=>'showByEducation',
	'uses'=>'HomeController@showByEducation'
]);


Route::any('showByOccupation', [
	'as'=>'showByOccupation',
	'uses'=>'HomeController@showByOccupation'
]);


Route::any('showByAnnualIncome', [
	'as'=>'showByAnnualIncome',
	'uses'=>'HomeController@showByAnnualIncome'
]);


Route::any('showByCity', [
	'as'=>'showByCity',
	'uses'=>'HomeController@showByCity'
]);

Route::any('showRegistration', [
	'as'=>'showRegistration',
	'uses'=>'HomeController@showRegistration'
]);


Route::get('logout', [
	'as'=>'logout',
	'uses'=>'Auth\LoginController@logout'
]);


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin', 'middleware'=>['auth', 'admin']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	Route::get('showChangePaswordForm', 'DashboardController@showChangePaswordForm')->name('showChangePaswordForm');

	Route::post('updateInfoForAdmin', 'DashboardController@updateInfoForAdmin')->name('updateInfoForAdmin');

	Route::get('showCompanyInfo', 'DashboardController@showCompanyInfo')->name('showCompanyInfo');

	Route::post('createCompanyInfo', 'DashboardController@createCompanyInfo')->name('createCompanyInfo');
	
	Route::get('showSliderImage', 'DashboardController@showSliderImage')->name('showSliderImage');

	Route::post('createSlider', 'DashboardController@createSlider')->name('createSlider');

	Route::get('showSliderList', 'DashboardController@showSliderList')->name('showSliderList');
	
	Route::get('deleteSliderImage/{id}', 'DashboardController@deleteSliderImage')->name('deleteSliderImage');

	Route::post('insertProfile', 'DashboardController@insertProfile')->name('insertProfile');
	
	Route::get('showPaidUsers', 'DashboardController@showPaidUsers')->name('showPaidUsers');
	
	Route::get('showUnpaidUsers', 'DashboardController@showUnpaidUsers')->name('showUnpaidUsers');
	

	Route::get('showUncompleteUsers', 'DashboardController@showUncompleteUsers')->name('showUncompleteUsers');
	
	Route::get('showAllUsers', 'DashboardController@showAllUsers')->name('showAllUsers');

	Route::get('showPublishedUsers', 'DashboardController@showPublishedUsers')->name('showPublishedUsers');

	Route::get('showUnpublishedUsers', 'DashboardController@showUnpublishedUsers')->name('showUnpublishedUsers');
		
	Route::get('showSearchUsers', 'DashboardController@showSearchUsers')->name('showSearchUsers');

	Route::get('deleteProfile/{$id}', 'DashboardController@deleteProfile')->name('deleteProfile');
	
	Route::get('showProfileForEdit/{id}', 'DashboardController@showProfileForEdit')->name('showProfileForEdit');

	Route::get('showFamilyInformation/{id}', 'DashboardController@showFamilyInformation')->name('showFamilyInformation');

	Route::get('showOccupation/{id}', 'DashboardController@showOccupation')->name('showOccupation');

	Route::get('showAbout/{id}', 'DashboardController@showAbout')->name('showAbout');

	Route::get('showPreferences/{id}', 'DashboardController@showPreferences')->name('showPreferences');

	Route::get('showFinish/{id}', 'DashboardController@showFinish')->name('showFinish');

	Route::post('createPersonalForAdmin/{id}', 'DashboardController@createPersonalForAdmin')->name('createPersonalForAdmin');

	Route::post('createFamilyForAdmin/{id}', 'DashboardController@createFamilyForAdmin')->name('createFamilyForAdmin');


	Route::post('createOccupationForAdmin/{id}', 'DashboardController@createOccupationForAdmin')->name('createOccupationForAdmin');


	Route::post('createAboutForAdmin/{id}', 'DashboardController@createAboutForAdmin')->name('createAboutForAdmin');

	Route::post('insertPreferenceForAdmin/{id}', 'DashboardController@insertPreferenceForAdmin')->name('insertPreferenceForAdmin');


	Route::post('createEducationForAdmin/{id}', 'DashboardController@createEducationForAdmin')->name('createEducationForAdmin');
	
	Route::get('showUnpublishedUsersById/{id}', 'DashboardController@showUnpublishedUsersById')->name('showUnpublishedUsersById');

	Route::get('changePublishStatus/{id}', 'DashboardController@changePublishStatus')->name('changePublishStatus');
	
	Route::get('showPublishedUsersById/{id}', 'DashboardController@showPublishedUsersById')->name('showPublishedUsersById');	
	
	Route::get('paidStatusChange/{id}', 'DashboardController@paidStatusChange')->name('paidStatusChange');
	
	Route::get('showNewProfile/', 'DashboardController@showNewProfile')->name('showNewProfile');

	Route::any('insertNewProfile/', 'DashboardController@insertNewProfile')->name('insertNewProfile');
	
	Route::get('showNewPost/', 'DashboardController@showNewPost')->name('showNewPost');
	
	Route::post('insertNewPost/', 'DashboardController@insertNewPost')->name('insertNewPost');

	Route::get('showAllPosts/', 'DashboardController@showAllPosts')->name('showAllPosts');
	
	Route::get('deletePost/{id}', 'DashboardController@deletePost')->name('deletePost');
	
	Route::get('showEditPost/{id}', 'DashboardController@showEditPost')->name('showEditPost');

	Route::post('updateNewPost/{id}', 'DashboardController@updateNewPost')->name('updateNewPost');

	Route::get('showNewLinks', 'DashboardController@showNewLinks')->name('showNewLinks');
	
	Route::post('insertNewLinks', 'DashboardController@insertNewLinks')->name('insertNewLinks');

	Route::get('showAllLinks', 'DashboardController@showAllLinks')->name('showAllLinks');
	
	Route::get('deleteLink/{id}', 'DashboardController@deleteLink')->name('deleteLink');
	
	Route::get('editLinks/{id}', 'DashboardController@editLinks')->name('editLinks');
	
	Route::post('updateNewLinks/{id}', 'DashboardController@updateNewLinks')->name('updateNewLinks');
	
	Route::get('showClientPackages/', 'DashboardController@showClientPackages')->name('showClientPackages');
	
	Route::get('showNewClPackage/', 'DashboardController@showNewClPackage')->name('showNewClPackage');
	
	Route::post('insertClientPackage/', 'DashboardController@insertClientPackage')->name('insertClientPackage');
	
	Route::get('deletePackageBy/{id}', 'DashboardController@deletePackageBy')->name('deletePackageBy');

	Route::get('editPackageBy/{id}', 'DashboardController@editPackageBy')->name('editPackageBy');

	Route::post('updatePackages/{id}', 'DashboardController@updatePackages')->name('updatePackages');
	
	Route::get('showAgentPackages/', 'DashboardController@showAgentPackages')->name('showAgentPackages');

	Route::get('showNewAgentPackage/', 'DashboardController@showNewAgentPackage')->name('showNewAgentPackage');
	
	Route::post('insertAgentPackage/', 'DashboardController@insertAgentPackage')->name('insertAgentPackage');

	Route::get('assignPackageForClient/{id}', 'DashboardController@assignPackageForClient')->name('assignPackageForClient');
	
	Route::get('showPackInfoBy', 'DashboardController@showPackInfoBy')->name('showPackInfoBy');
	
	Route::post('insertAssign/{id}', 'DashboardController@insertAssign')->name('insertAssign');
	
	Route::get('editAssignPackage/{id}', 'DashboardController@editAssignPackage')->name('editAssignPackage');
	
	Route::post('updateAssignPackage/{id}', 'DashboardController@updateAssignPackage')->name('updateAssignPackage');

	Route::get('showAgentList/', 'DashboardController@showAgentList')->name('showAgentList');

	Route::get('showNewAgent/', 'DashboardController@showNewAgent')->name('showNewAgent');
	
	Route::post('insertNewAgent/', 'DashboardController@insertNewAgent')->name('insertNewAgent');

	Route::get('editAgent/{id}', 'DashboardController@editAgent')->name('editAgent');
	
	Route::post('updateAgent/{id}', 'DashboardController@updateAgent')->name('updateAgent');	

	Route::get('changeAgentStatus/{id}', 'DashboardController@changeAgentStatus')->name('changeAgentStatus');
	
	Route::get('showUnpaidAgent/', 'DashboardController@showUnpaidAgent')->name('showUnpaidAgent');
	
	Route::get('agentView/{id}', 'DashboardController@agentView')->name('agentView');
	
	Route::post('insertAssignForAgent/', 'DashboardController@insertAssignForAgent')->name('insertAssignForAgent');	

	Route::get('showPaidAgent/', 'DashboardController@showPaidAgent')->name('showPaidAgent');	

	Route::get('editAgentView/{id}', 'DashboardController@editAgentView')->name('editAgentView');	
	
	Route::post('updateAgentAssign/{id}', 'DashboardController@updateAgentAssign')->name('updateAgentAssign');	
	
	Route::get('showAgentExpInfo/', 'DashboardController@showAgentExpInfo')->name('showAgentExpInfo');	
	
	Route::get('showNewUser/', 'DashboardController@showNewUser')->name('showNewUser');	
	
	Route::post('insertNewUser/', 'DashboardController@insertNewUser')->name('insertNewUser');	
	
	Route::get('showAllNormalUsers/', 'DashboardController@showAllNormalUsers')->name('showAllNormalUsers');

	Route::get('deleteUsersList/{id}', 'DashboardController@deleteUsersList')->name('deleteUsersList');
		
	Route::get('editUsersList/{id}', 'DashboardController@editUsersList')->name('editUsersList');

	Route::post('updateUsersList/{id}', 'DashboardController@updateUsersList')->name('updateUsersList');
	
	Route::get('changeActiveStatus/{id}', 'DashboardController@changeActiveStatus')->name('changeActiveStatus');
	
	Route::get('showReceivePayment/', 'DashboardController@showReceivePayment')->name('showReceivePayment');
	
	Route::get('verifyPayment/{id}', 'DashboardController@verifyPayment')->name('verifyPayment');
	
	Route::any('showPersonalInfoForAdmin/{$id}', 'DashboardController@showPersonalInfoForAdmin')->name('showPersonalInfoForAdmin');

	Route::get('showTeamMember/', 'DashboardController@showTeamMember')->name('showTeamMember');

	Route::post('insertTeamMember/', 'DashboardController@insertTeamMember')->name('insertTeamMember');

	Route::get('deleteTeamMember/{id}', 'DashboardController@deleteTeamMember')->name('deleteTeamMember');

	Route::post('updateTeamMember/{id}', 'DashboardController@updateTeamMember')->name('updateTeamMember');

	Route::get('showCityForAdmin/', 'DashboardController@showCityForAdmin')->name('showCityForAdmin');

	Route::get('showAllUsersViewById/{id}', 'DashboardController@showAllUsersViewById')->name('showAllUsersViewById');

	Route::post('allsearch/', 'DashboardController@allsearch')->name('allsearch');

	Route::post('receivePayment/{id}', 'DashboardController@receivePayment')->name('receivePayment');

	Route::get('getDataByPackageId', 'DashboardController@getDataByPackageId')->name('getDataByPackageId');

	Route::get('showMessage', 'DashboardController@showMessage')->name('showMessage');

	Route::get('showReplyMessage/{id}', 'DashboardController@showReplyMessage')->name('showReplyMessage');
});

Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'User', 'middleware'=>['auth', 'user']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	Route::get('showChangePaswordForm', 'DashboardController@showChangePaswordForm')->name('showChangePaswordForm');

	Route::post('updateInfoForAdmin', 'DashboardController@updateInfoForAdmin')->name('updateInfoForAdmin');

	Route::get('showCompanyInfo', 'DashboardController@showCompanyInfo')->name('showCompanyInfo');

	Route::post('createCompanyInfo', 'DashboardController@createCompanyInfo')->name('createCompanyInfo');
	
	Route::get('showSliderImage', 'DashboardController@showSliderImage')->name('showSliderImage');

	Route::post('createSlider', 'DashboardController@createSlider')->name('createSlider');

	Route::get('showSliderList', 'DashboardController@showSliderList')->name('showSliderList');
	
	Route::get('deleteSliderImage/{id}', 'DashboardController@deleteSliderImage')->name('deleteSliderImage');

	Route::post('insertProfile', 'DashboardController@insertProfile')->name('insertProfile');
	
	Route::get('showPaidUsers', 'DashboardController@showPaidUsers')->name('showPaidUsers');
	
	Route::get('showUnpaidUsers', 'DashboardController@showUnpaidUsers')->name('showUnpaidUsers');
	

	Route::get('showUncompleteUsers', 'DashboardController@showUncompleteUsers')->name('showUncompleteUsers');
	
	Route::get('showAllUsers', 'DashboardController@showAllUsers')->name('showAllUsers');

	Route::get('showPublishedUsers', 'DashboardController@showPublishedUsers')->name('showPublishedUsers');

	Route::get('showUnpublishedUsers', 'DashboardController@showUnpublishedUsers')->name('showUnpublishedUsers');
		
	Route::get('showSearchUsers', 'DashboardController@showSearchUsers')->name('showSearchUsers');

	Route::get('deleteProfile/{$id}', 'DashboardController@deleteProfile')->name('deleteProfile');
	
	Route::get('showProfileForEdit/{id}', 'DashboardController@showProfileForEdit')->name('showProfileForEdit');

	Route::get('showFamilyInformation/{id}', 'DashboardController@showFamilyInformation')->name('showFamilyInformation');

	Route::get('showOccupation/{id}', 'DashboardController@showOccupation')->name('showOccupation');

	Route::get('showAbout/{id}', 'DashboardController@showAbout')->name('showAbout');

	Route::get('showPreferences/{id}', 'DashboardController@showPreferences')->name('showPreferences');

	Route::get('showFinish/{id}', 'DashboardController@showFinish')->name('showFinish');

	Route::post('createPersonalForAdmin/{id}', 'DashboardController@createPersonalForAdmin')->name('createPersonalForAdmin');

	Route::post('createFamilyForAdmin/{id}', 'DashboardController@createFamilyForAdmin')->name('createFamilyForAdmin');


	Route::post('createOccupationForAdmin/{id}', 'DashboardController@createOccupationForAdmin')->name('createOccupationForAdmin');


	Route::post('createAboutForAdmin/{id}', 'DashboardController@createAboutForAdmin')->name('createAboutForAdmin');

	Route::post('insertPreferenceForAdmin/{id}', 'DashboardController@insertPreferenceForAdmin')->name('insertPreferenceForAdmin');


	Route::post('createEducationForAdmin/{id}', 'DashboardController@createEducationForAdmin')->name('createEducationForAdmin');
	
	Route::get('showUnpublishedUsersById/{id}', 'DashboardController@showUnpublishedUsersById')->name('showUnpublishedUsersById');

	Route::get('changePublishStatus/{id}', 'DashboardController@changePublishStatus')->name('changePublishStatus');
	
	Route::get('showPublishedUsersById/{id}', 'DashboardController@showPublishedUsersById')->name('showPublishedUsersById');	
	
	Route::get('paidStatusChange/{id}', 'DashboardController@paidStatusChange')->name('paidStatusChange');
	
	Route::get('showNewProfile/', 'DashboardController@showNewProfile')->name('showNewProfile');

	Route::post('insertNewProfile/', 'DashboardController@insertNewProfile')->name('insertNewProfile');
	
	Route::get('showNewPost/', 'DashboardController@showNewPost')->name('showNewPost');
	
	Route::post('insertNewPost/', 'DashboardController@insertNewPost')->name('insertNewPost');

	Route::get('showAllPosts/', 'DashboardController@showAllPosts')->name('showAllPosts');
	
	Route::get('deletePost/{id}', 'DashboardController@deletePost')->name('deletePost');
	
	Route::get('showEditPost/{id}', 'DashboardController@showEditPost')->name('showEditPost');

	Route::post('updateNewPost/{id}', 'DashboardController@updateNewPost')->name('updateNewPost');

	Route::get('showNewLinks', 'DashboardController@showNewLinks')->name('showNewLinks');
	
	Route::post('insertNewLinks', 'DashboardController@insertNewLinks')->name('insertNewLinks');

	Route::get('showAllLinks', 'DashboardController@showAllLinks')->name('showAllLinks');
	
	Route::get('deleteLink/{id}', 'DashboardController@deleteLink')->name('deleteLink');
	
	Route::get('editLinks/{id}', 'DashboardController@editLinks')->name('editLinks');
	
	Route::post('updateNewLinks/{id}', 'DashboardController@updateNewLinks')->name('updateNewLinks');
	
	Route::get('showClientPackages/', 'DashboardController@showClientPackages')->name('showClientPackages');
	
	Route::get('showNewClPackage/', 'DashboardController@showNewClPackage')->name('showNewClPackage');
	
	Route::post('insertClientPackage/', 'DashboardController@insertClientPackage')->name('insertClientPackage');
	
	Route::get('deletePackageBy/{id}', 'DashboardController@deletePackageBy')->name('deletePackageBy');

	Route::get('editPackageBy/{id}', 'DashboardController@editPackageBy')->name('editPackageBy');

	Route::post('updatePackages/{id}', 'DashboardController@updatePackages')->name('updatePackages');
	
	Route::get('showAgentPackages/', 'DashboardController@showAgentPackages')->name('showAgentPackages');

	Route::get('showNewAgentPackage/', 'DashboardController@showNewAgentPackage')->name('showNewAgentPackage');
	
	Route::post('insertAgentPackage/', 'DashboardController@insertAgentPackage')->name('insertAgentPackage');

	Route::get('assignPackageForClient/{id}', 'DashboardController@assignPackageForClient')->name('assignPackageForClient');
	
	Route::get('showPackInfoBy', 'DashboardController@showPackInfoBy')->name('showPackInfoBy');
	
	Route::post('insertAssign/{id}', 'DashboardController@insertAssign')->name('insertAssign');
	
	Route::get('editAssignPackage/{id}', 'DashboardController@editAssignPackage')->name('editAssignPackage');
	
	Route::post('updateAssignPackage/{id}', 'DashboardController@updateAssignPackage')->name('updateAssignPackage');

	Route::get('showAgentList/', 'DashboardController@showAgentList')->name('showAgentList');

	Route::get('showNewAgent/', 'DashboardController@showNewAgent')->name('showNewAgent');
	
	Route::post('insertNewAgent/', 'DashboardController@insertNewAgent')->name('insertNewAgent');

	Route::get('editAgent/{id}', 'DashboardController@editAgent')->name('editAgent');
	
	Route::post('updateAgent/{id}', 'DashboardController@updateAgent')->name('updateAgent');	

	Route::get('changeAgentStatus/{id}', 'DashboardController@changeAgentStatus')->name('changeAgentStatus');
	
	Route::get('showUnpaidAgent/', 'DashboardController@showUnpaidAgent')->name('showUnpaidAgent');
	
	Route::get('agentView/{id}', 'DashboardController@agentView')->name('agentView');
	
	Route::post('insertAssignForAgent/', 'DashboardController@insertAssignForAgent')->name('insertAssignForAgent');	

	Route::get('showPaidAgent/', 'DashboardController@showPaidAgent')->name('showPaidAgent');	

	Route::get('editAgentView/{id}', 'DashboardController@editAgentView')->name('editAgentView');	
	
	Route::post('updateAgentAssign/{id}', 'DashboardController@updateAgentAssign')->name('updateAgentAssign');	
	
	Route::get('showAgentExpInfo/', 'DashboardController@showAgentExpInfo')->name('showAgentExpInfo');	
	
	Route::get('showNewUser/', 'DashboardController@showNewUser')->name('showNewUser');	
	
	Route::post('insertNewUser/', 'DashboardController@insertNewUser')->name('insertNewUser');	
	
	Route::get('showAllNormalUsers/', 'DashboardController@showAllNormalUsers')->name('showAllNormalUsers');

	Route::get('deleteUsersList/{id}', 'DashboardController@deleteUsersList')->name('deleteUsersList');
		
	Route::get('editUsersList/{id}', 'DashboardController@editUsersList')->name('editUsersList');

	Route::post('updateUsersList/{id}', 'DashboardController@updateUsersList')->name('updateUsersList');
	
	Route::get('changeActiveStatus/{id}', 'DashboardController@changeActiveStatus')->name('changeActiveStatus');
	
	Route::get('showReceivePayment/', 'DashboardController@showReceivePayment')->name('showReceivePayment');
	
	Route::get('verifyPayment/{id}', 'DashboardController@verifyPayment')->name('verifyPayment');
	
	Route::any('showPersonalInfoForAdmin/{$id}', 'DashboardController@showPersonalInfoForAdmin')->name('showPersonalInfoForAdmin');

	Route::get('showTeamMember/', 'DashboardController@showTeamMember')->name('showTeamMember');

	Route::post('insertTeamMember/', 'DashboardController@insertTeamMember')->name('insertTeamMember');

	Route::get('deleteTeamMember/{id}', 'DashboardController@deleteTeamMember')->name('deleteTeamMember');

	Route::post('updateTeamMember/{id}', 'DashboardController@updateTeamMember')->name('updateTeamMember');

	Route::get('showCityForAdmin/', 'DashboardController@showCityForAdmin')->name('showCityForAdmin');

	Route::get('showAllUsersViewById/{id}', 'DashboardController@showAllUsersViewById')->name('showAllUsersViewById');

	Route::post('allsearch/', 'DashboardController@allsearch')->name('allsearch');
	

});

Route::group(['as'=>'agent.','prefix'=>'agent','namespace'=>'Agent', 'middleware'=>['auth', 'agent']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	Route::get('showAgentPaidUsers/', 'DashboardController@showAgentPaidUsers')->name('showAgentPaidUsers');

	Route::get('showAgentUnpaidUsers/', 'DashboardController@showAgentUnpaidUsers')->name('showAgentUnpaidUsers');


	Route::get('showAgentUncompleteUsers/', 'DashboardController@showAgentUncompleteUsers')->name('showAgentUncompleteUsers');

	Route::get('showAgentPublishedUsers/', 'DashboardController@showAgentPublishedUsers')->name('showAgentPublishedUsers');

	Route::get('showAgentUnpublishedUsers/', 'DashboardController@showAgentUnpublishedUsers')->name('showAgentUnpublishedUsers');

	Route::get('showAgentAllUsers/', 'DashboardController@showAgentAllUsers')->name('showAgentAllUsers');

	Route::get('showAgentUncompleteProfile/{id}', 'DashboardController@showAgentUncompleteProfile')->name('showAgentUncompleteProfile');

	Route::get('showAgentAllProfile/{id}', 'DashboardController@showAgentAllProfile')->name('showAgentAllProfile');
	
	Route::get('showPublishedAgentProById/{id}', 'DashboardController@showPublishedAgentProById')->name('showPublishedAgentProById');
	
	Route::get('showUnpublishedAgentProById/{id}', 'DashboardController@showUnpublishedAgentProById')->name('showUnpublishedAgentProById');
	
	Route::get('changePublishStatusByAgent/{id}', 'DashboardController@changePublishStatusByAgent')->name('changePublishStatusByAgent');

	Route::get('deleteProfileAgent/{id}', 'DashboardController@deleteProfileAgent')->name('deleteProfileAgent');

	Route::post('createPersonalForAgent/{id}', 'DashboardController@createPersonalForAgent')->name('createPersonalForAgent');

	Route::post('createFamilyForAgent/{id}', 'DashboardController@createFamilyForAgent')->name('createFamilyForAgent');


	Route::post('createOccupationForAgent/{id}', 'DashboardController@createOccupationForAgent')->name('createOccupationForAgent');


	Route::post('createAboutForAgent/{id}', 'DashboardController@createAboutForAgent')->name('createAboutForAgent');

	Route::post('createEducationForAgent/{id}', 'DashboardController@createEducationForAgent')->name('createEducationForAgent');

	Route::post('insertPreferenceForAgent/{id}', 'DashboardController@insertPreferenceForAgent')->name('insertPreferenceForAgent');

	Route::get('agentViewThis/{id}', 'DashboardController@agentViewThis')->name('agentViewThis');
	
	Route::get('showPackForAgent/', 'DashboardController@showPackForAgent')->name('showPackForAgent');
	
	Route::post('insertAssignForAgent/', 'DashboardController@insertAssignForAgent')->name('insertAssignForAgent');
	
	Route::get('showAgentPaidView/{id}', 'DashboardController@showAgentPaidView')->name('showAgentPaidView');
	
	Route::post('updateAssignForAgent/', 'DashboardController@updateAssignForAgent')->name('updateAssignForAgent');
	
	Route::get('showUnpubProfile/{id}', 'DashboardController@showUnpubProfile')->name('showUnpubProfile');
	
	Route::get('agentNewProfile/', 'DashboardController@agentNewProfile')->name('agentNewProfile');
	
	Route::post('createNewProfile/', 'DashboardController@createNewProfile')->name('createNewProfile');

	Route::get('showExpiryUsers/', 'DashboardController@showExpiryUsers')->name('showExpiryUsers');
	
	Route::get('showExpiryView/{id}', 'DashboardController@showExpiryView')->name('showExpiryView');

	Route::get('showPackagesByAgent/', 'DashboardController@showPackagesByAgent')->name('showPackagesByAgent');
	
	Route::get('showPackageByAgent/', 'DashboardController@showPackageByAgent')->name('showPackageByAgent');

	Route::post('insertPackageByAgent/', 'DashboardController@insertPackageByAgent')->name('insertPackageByAgent');

	Route::get('editPackageByAgent/{id}', 'DashboardController@editPackageByAgent')->name('editPackageByAgent');
	
	Route::post('updatePackagesByAgent/{id}', 'DashboardController@updatePackagesByAgent')->name('updatePackagesByAgent');	
	
	Route::post('insertExpiryPayment/', 'DashboardController@insertExpiryPayment')->name('insertExpiryPayment');	

	Route::get('showAgentProfile/', 'DashboardController@showAgentProfile')->name('showAgentProfile');

	Route::post('updateAgentProfile/{id}', 'DashboardController@updateAgentProfile')->name('updateAgentProfile');	
	
	Route::get('agentChangePassword/', 'DashboardController@agentChangePassword')->name('agentChangePassword');

	Route::post('updateAgentPassword/', 'DashboardController@updateAgentPassword')->name('updateAgentPassword');	
	
	Route::get('showReceivePaymentForAgent/', 'DashboardController@showReceivePaymentForAgent')->name('showReceivePaymentForAgent');	

	Route::get('verifyPaymentForAgent/{id}', 'DashboardController@verifyPaymentForAgent')->name('verifyPaymentForAgent');	

	Route::get('showProfileForEdit/{id}', 'DashboardController@showProfileForEdit')->name('showProfileForEdit');

	Route::get('showFamilyInformation/{id}', 'DashboardController@showFamilyInformation')->name('showFamilyInformation');

	Route::get('showOccupation/{id}', 'DashboardController@showOccupation')->name('showOccupation');

	Route::get('showAbout/{id}', 'DashboardController@showAbout')->name('showAbout');

	Route::get('showPreferences/{id}', 'DashboardController@showPreferences')->name('showPreferences');

	Route::get('showFinishForAgent/{id}', 'DashboardController@showFinishForAgent')->name('showFinishForAgent');
	
	
});


Route::group(['as'=>'client.','prefix'=>'client','namespace'=>'Client', 'middleware'=>['auth', 'client']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	Route::get('showClientProfile', 'DashboardController@showClientProfile')->name('showClientProfile');

	Route::post('createPersonal', 'DashboardController@createPersonal')->name('createPersonal');

	Route::post('createFamily', 'DashboardController@createFamily')->name('createFamily');
	
	Route::post('createOccupation', 'DashboardController@createOccupation')->name('createOccupation');

	Route::post('createAbout', 'DashboardController@createAbout')->name('createAbout');
	
	Route::post('createEducation', 'DashboardController@createEducation')->name('createEducation');
		
	Route::get('showChangePasword', 'DashboardController@showChangePasword')->name('showChangePasword');

	Route::post('updateInfoForClient', 'DashboardController@updateInfoForClient')->name('updateInfoForClient');
	
	Route::get('showFollowers', 'DashboardController@showFollowers')->name('showFollowers');	
	
	Route::get('showFollowersView/{id}', 'DashboardController@showFollowersView')->name('showFollowersView');	
	
	Route::get('clientSendProposal/{id}', 'DashboardController@clientSendProposal')->name('clientSendProposal');	

	Route::get('showProposals/', 'DashboardController@showProposals')->name('showProposals');	
	
	Route::get('showProposalsView/{id}', 'DashboardController@showProposalsView')->name('showProposalsView');	

	Route::get('acceptProposals/{id}', 'DashboardController@acceptProposals')->name('acceptProposals');	
	
	Route::get('showFollowList/', 'DashboardController@showFollowList')->name('showFollowList');	

	Route::get('showFollowListView/{id}', 'DashboardController@showFollowListView')->name('showFollowListView');	
	
	Route::get('showSendProposals/', 'DashboardController@showSendProposals')->name('showSendProposals');	
	
	Route::get('showSendProposalView/{id}', 'DashboardController@showSendProposalView')->name('showSendProposalView');	
	
	Route::get('showViewers/', 'DashboardController@showViewers')->name('showViewers');	

	Route::get('showViewProfileClient/{id}', 'DashboardController@showViewProfileClient')->name('showViewProfileClient');
	
	Route::get('showViewersList/', 'DashboardController@showViewersList')->name('showViewersList');		
	
	Route::get('showViewersProfile/{id}', 'DashboardController@showViewersProfile')->name('showViewersProfile');

	Route::get('showPreference/', 'DashboardController@showPreference')->name('showPreference');
	
	Route::post('insertPreference/', 'DashboardController@insertPreference')->name('insertPreference');
	
	Route::get('showPaymentDetails/', 'DashboardController@showPaymentDetails')->name('showPaymentDetails');
	
	Route::post('insertPaymentDetails/', 'DashboardController@insertPaymentDetails')->name('insertPaymentDetails');

	Route::get('viewProfile/', 'DashboardController@viewProfile')->name('viewProfile');


	Route::get('showCityForClient/', 'DashboardController@showCityForClient')->name('showCityForClient');

	Route::post('sendMessageByClient/', 'DashboardController@sendMessageByClient')->name('sendMessageByClient');

	Route::get('showInbox/', 'DashboardController@showInbox')->name('showInbox');

	Route::get('showIndexProfile/{id}', 'DashboardController@showIndexProfile')->name('showIndexProfile');

	Route::get('showMessageList/{id}', 'DashboardController@showMessageList')->name('showMessageList');
	
	Route::get('showSentMessage/', 'DashboardController@showSentMessage')->name('showSentMessage');

	Route::get('showPersonalInformation/', 'DashboardController@showPersonalInformation')->name('showPersonalInformation');

	Route::get('showFamilyInformation/', 'DashboardController@showFamilyInformation')->name('showFamilyInformation');

	Route::get('showOccupation/', 'DashboardController@showOccupation')->name('showOccupation');

	Route::get('showAbout/', 'DashboardController@showAbout')->name('showAbout');

	Route::get('showFinish/', 'DashboardController@showFinish')->name('showFinish');

	Route::post('changePicture/', 'DashboardController@changePicture')->name('changePicture');

	Route::get('showPreferences/', 'DashboardController@showPreferences')->name('showPreferences');

	Route::any('suggestionSearch/', 'DashboardController@suggestionSearch')->name('suggestionSearch');

	Route::get('showSuggestionProfile/{id}', 'DashboardController@showSuggestionProfile')->name('showSuggestionProfile');

	Route::any('showAdminMessage/', 'DashboardController@showAdminMessage')->name('showAdminMessage');

	Route::post('sendAdminMessage/', 'DashboardController@sendAdminMessage')->name('sendAdminMessage');

	Route::get('showSentProfile/{id}', 'DashboardController@showSentProfile')->name('showSentProfile');

	Route::get('showSentMessageList/{id}', 'DashboardController@showSentMessageList')->name('showSentMessageList');


	Route::get('clientPackageSelectByID', 'DashboardController@clientPackageSelectByID')->name('clientPackageSelectByID');


	
});