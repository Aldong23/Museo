<?php

use App\Livewire\Admin\VisitorMapping\Cultural;
use App\Livewire\Admin\VisitorMapping\Immovable;
use App\Livewire\Admin\VisitorMapping\Intangible;
use App\Livewire\Admin\VisitorMapping\Movable;
use App\Livewire\Admin\VisitorMapping\SignificantPersonalities;
use App\Livewire\Admin\VisitorMapping\Snr;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrowserShot\Qrcode;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\VisitorForm;
use App\Http\Controllers\VisitorMapping;
use App\Http\Controllers\VisitorViewController;
use App\Livewire\Admin\AccountManagement\AccountManagement;
use App\Livewire\Admin\AccountManagement\AccountManagementCreate;
use App\Livewire\Admin\AccountManagement\AccountManagementEdit;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsCreate;
use App\Livewire\Admin\ArtifactsManagement\RestorationInProgress;
use App\Livewire\Admin\ArtifactsManagement\RestorationRestored;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsEdit;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsExhibitApproval;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsExhibitMonitoring;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsExhibitMonitoringCreate;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsManagement;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsRestoration;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsRestorationInProgress;
use App\Livewire\Admin\ArtifactsManagement\ArtifactsRestorationRestored;
use App\Livewire\Admin\Auth\CodeVerification;
use App\Livewire\Admin\Auth\ForgotPassword;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Auth\NewPassword;
use App\Livewire\Admin\Contributor\Contributor;
use App\Livewire\Admin\Contributor\ContributorCreate;
use App\Livewire\Admin\Contributor\ContributorView;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\MappingHeritage\MappingHeritage;
use App\Livewire\Admin\MappingHeritage\MappingHeritageCreate;
use App\Livewire\Admin\MappingHeritage\HeritageView;
use App\Livewire\Admin\ReportGeneration\ContributorReport;
use App\Livewire\Admin\ReportGeneration\StatisticsCc;
use App\Livewire\Admin\ReportGeneration\StatisticsOverallView;
use App\Livewire\Admin\ReportGeneration\StatisticsSqd;
use App\Livewire\Admin\ReportGeneration\VisitorFeedback as ReportGenerationVisitorFeedback;
use App\Livewire\Admin\ReportGeneration\VisitorReport;
use App\Livewire\Admin\VisitorMonitoring\VisitorFeedback;
use App\Livewire\Admin\VisitorMonitoring\VisitorProfiling;
use App\Livewire\Admin\VisitorMonitoring\VisitorRegistration;
use App\Livewire\Admin\Profile;
use App\Livewire\Visitor\AfterFeedback;
use App\Livewire\Visitor\EmailValidation;
use App\Livewire\Visitor\HomePage;
use App\Livewire\Visitor\NotApproved;
use App\Livewire\Visitor\ReturningVisitorForm;
use App\Livewire\Visitor\VisitorQrcode;
use App\Livewire\VisitorForm as LivewireVisitorForm;
use App\Mail\ForgotPassword as MailForgotPassword;
use App\Models\Visitor;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\MappingHeritage\Edit\Animals;
use App\Livewire\Admin\MappingHeritage\Edit\ArchivalHoldings;
use App\Livewire\Admin\MappingHeritage\Edit\Association;
use App\Livewire\Admin\MappingHeritage\Edit\BodiesOFWater;
use App\Livewire\Admin\MappingHeritage\Edit\CriticalArea;
use App\Livewire\Admin\MappingHeritage\Edit\EthnographicObject;
use App\Livewire\Admin\MappingHeritage\Edit\FarmersAssociation;
use App\Livewire\Admin\MappingHeritage\Edit\Government;
use App\Livewire\Admin\MappingHeritage\Edit\Houses;
use App\Livewire\Admin\MappingHeritage\Edit\KnowledgeAndPractices;
use App\Livewire\Admin\MappingHeritage\Edit\OralTraditions;
use App\Livewire\Admin\MappingHeritage\Edit\Plants;
use App\Livewire\Admin\MappingHeritage\Edit\PoliticalClan;
use App\Livewire\Admin\MappingHeritage\Edit\ProtectedArea;
use App\Livewire\Admin\MappingHeritage\Edit\SchoolInstitutions;
use App\Livewire\Admin\MappingHeritage\Edit\SchoolInstitutionsLibrary;
use App\Livewire\Admin\MappingHeritage\Edit\SignificantPersonalities as EditSignificantPersonalities;
use App\Livewire\Admin\MappingHeritage\Edit\Sites;
use App\Livewire\Admin\MappingHeritage\Edit\SocialPractices;
use App\Livewire\Admin\MappingHeritage\Edit\TraditionalCraftsmanship;

// Route::get('/mail', function () {
//     Mail::to('jimenezaron2001@gmail.com')->send(
//         new MailForgotPassword()
//     );

//     flash()->success('Email sent');
// });

//* ==================================================== ADMIN ROUTES =========================================== >>

//* ============================================ PROFILE ==== >>
Route::get('/profile', Profile::class)->name('profile')->middleware('auth');

//* ============================================ AUTHENTICATION ==== >>

Route::get('/forgot-password', ForgotPassword::class)->name('forgot.password');
Route::get('/code-verification/{id}', CodeVerification::class)->name('code.verification');

Route::middleware(['guest'])->group(function () {
  
    Route::get('/login', Login::class)->name('login');
    
});

Route::get('/feedback-success', AfterFeedback::class);

//* ============================================ DASHOARD ==== >>

Route::get('/', Dashboard::class)->name('dashboard')->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


//* ============================================ ARTIFACTS MANAGEMENTS ==== >>

Route::middleware(['auth'])->group(function () {

    Route::get('/artifacts-managements', ArtifactsManagement::class);
    Route::get('/artifacts-archived', App\Livewire\Admin\ArtifactsManagement\ArtifactsArchived::class);
    Route::get('/artifacts-create', ArtifactsCreate::class);
    Route::get('/artifacts-restoration-view/{id}', App\Livewire\Admin\ArtifactsManagement\ArtifactsRestorationView::class);
    Route::get('/restoration-in-progress', RestorationInProgress::class);
    Route::get('/restoration-restored', RestorationRestored::class);
    Route::get('/artifacts-edit/{id}', ArtifactsEdit::class);
    Route::get('/artifacts-view/{id}', App\Livewire\Admin\ArtifactsManagement\ArtifactsView::class);
    Route::get('/generate/in-progress-letter/{id}', App\Livewire\Admin\ArtifactsManagement\LetterInProgress::class);
    Route::get('/generate/restored-letter/{id}', App\Livewire\Admin\ArtifactsManagement\LetterRestored::class);
    //====================
    Route::get('/artifacts-restoration', ArtifactsRestoration::class);
    Route::get('/artifacts-restoration/in-progress', ArtifactsRestorationInProgress::class);
    Route::get('/artifacts-restoration/restored/{id}', ArtifactsRestorationRestored::class);
});


Route::middleware(['auth'])->group(function () {

    Route::get('/artifacts-exhibit-monitoring', ArtifactsExhibitMonitoring::class);
    Route::get('/artifacts-exhibit-monitoring-create', ArtifactsExhibitMonitoringCreate::class);
    Route::get('/artifacts-exhibit-approval/{id}', ArtifactsExhibitApproval::class);
    Route::get('/artifacts-exhibit-view/{id}', App\Livewire\Admin\ArtifactsManagement\ArtifactsExhibitView::class);
});


//* ============================================ MAPPING HERITAGE ==== >>

Route::get('/mapping-heritage', MappingHeritage::class)->middleware('auth');
Route::get('/mapping-heritage-create', MappingHeritageCreate::class)->middleware('auth');

// SNR
Route::get('/edit/animals/{id}', Animals::class)->name('animals.edit')->middleware('auth');
Route::get('/edit/bodies-of-water/{id}', BodiesOFWater::class)->name('bow.edit')->middleware('auth');
Route::get('/edit/plants/{id}', Plants::class)->name('plants.edit')->middleware('auth');
Route::get('/edit/protected-area/{id}', ProtectedArea::class)->name('protected-area.edit')->middleware('auth');
Route::get('/edit/critical-area/{id}', CriticalArea::class)->name('protected-area.edit')->middleware('auth');

// Tangible-Immovable Cultural Heritage
Route::get('/edit/sites/{id}', Sites::class)->name('sites.edit')->middleware('auth');
Route::get('/edit/houses/{id}', Houses::class)->name('houses.edit')->middleware('auth');
Route::get('/edit/government/{id}', Government::class)->name('government.edit')->middleware('auth');

// Tangible-Movable Cultural Heritage
Route::get('/edit/ethnographic-object/{id}', EthnographicObject::class)->name('ethnographic.edit')->middleware('auth');
Route::get('/edit/archival-holdings/{id}', ArchivalHoldings::class)->name('archival.edit')->middleware('auth');

// INTANGIBLE
Route::get('/edit/social-practices/{id}', SocialPractices::class)->name('socprac.edit')->middleware('auth');
Route::get('/edit/knp/{id}', KnowledgeAndPractices::class)->name('knp.edit')->middleware('auth');
Route::get('/edit/traditional-craftsmanship/{id}', TraditionalCraftsmanship::class)->name('traditional.edit')->middleware('auth');
Route::get('/edit/oral-tradition/{id}', OralTraditions::class)->name('oral-traditional.edit')->middleware('auth');

// Significant Personalities
Route::get('/edit/significant-personalities/{id}', EditSignificantPersonalities::class)->name('personalities.edit')->middleware('auth');

// Cultural Institutions
Route::get('/edit/school-institutions/{id}', SchoolInstitutions::class)->name('school-ins.edit')->middleware('auth');
Route::get('/edit/school-institutions-library/{id}', SchoolInstitutionsLibrary::class)->name('school-ins-lib.edit')->middleware('auth');
Route::get('/edit/farmers-association/{id}', FarmersAssociation::class)->name('farmers.edit')->middleware('auth');
Route::get('/edit/associations/{id}', Association::class)->name('assoc.edit')->middleware('auth');
Route::get('/edit/political-clan/{id}', PoliticalClan::class)->name('political-clan.edit')->middleware('auth');


//* ============================================ ACCOUNT MANAGEMENT ==== >>
Route::middleware(['auth'])->group(function () {
    Route::get('/account-management', AccountManagement::class);
    Route::get('/account-archived', App\Livewire\Admin\AccountManagement\AccountArchived::class);
    Route::get('/account-management-create', AccountManagementCreate::class);
    Route::get('/account-management-edit/{id}', AccountManagementEdit::class);
});

//* ============================================ Audit Logs Monitoring ==== >>
Route::get('/audit-logs',  App\Livewire\Admin\AuditLogMonitoring\AuditLog::class)->middleware('auth');


//* ============================================ VISITOR MONITORING ==== >>

Route::middleware(['auth'])->group(function () {

    Route::get('/visitor-view/{id}', App\Livewire\Admin\VisitorMonitoring\VisitorView::class);
    Route::get('/visitor-registration', VisitorRegistration::class);
    Route::get('/visitor-profiling', VisitorProfiling::class);
    Route::get('/visitor-archived', App\Livewire\Admin\VisitorMonitoring\VisitorArchived::class);
    Route::get('/visitor-profiling-view/{id}', App\Livewire\Admin\VisitorMonitoring\VisitorProfileView::class);
    Route::get('/visitor-feedback', VisitorFeedback::class);
    Route::get('/visitor-feedback-view/{id}', App\Livewire\Admin\VisitorMonitoring\VisitorFeedbackView::class);
});



//* ============================================ CONTRIBUTOR ==== >>

Route::get('/contributor', Contributor::class)->middleware('auth');
Route::get('/contributor-create', ContributorCreate::class);
Route::get('/contributor-view={id}', ContributorView::class)->middleware('auth');


//* ============================================ REPORT GENERATION ==== >>


Route::middleware(['auth'])->group(function () {

    Route::get('/visitor-report', VisitorReport::class);
    Route::get('/visitor-report-view/{id}', App\Livewire\Admin\ReportGeneration\VisitorView::class);
    Route::get('/visitor-report-feedback-view/{id}', App\Livewire\Admin\ReportGeneration\VisitorFeedbackView::class);
    Route::get('/contributor-report', ContributorReport::class);
    Route::get('/contributor-view/{id}', App\Livewire\Admin\ReportGeneration\ContributorView::class);
    Route::get('/contributor-letter-edit', App\Livewire\Admin\ReportGeneration\ContributorLetterEdit::class);
    Route::get('/contributor-letter/{id}', App\Livewire\Admin\ReportGeneration\ContributorLetter::class);
    Route::get('/visitor-feedback-generation', ReportGenerationVisitorFeedback::class);
    //under visitor feedback statistics
    Route::get('/statistics-overall-view', StatisticsOverallView::class);
    Route::get('/statistics-cc', StatisticsCc::class);
    Route::get('/statistics-sqd', StatisticsSqd::class);
});


//* ==================================================== VISITOR ROUTES =========================================== >>
Route::middleware('authVisitor')->group(function () {
    Route::get('/visitor-qrcode', VisitorQrcode::class)->name('visitor.qrcode');
    Route::get('/visitor-login/{control_no}', [AuthController::class, 'loginVisitor'])->name('visitor.login');
    Route::get('/not-approved', NotApproved::class)->name('not.approved');
});

Route::middleware('expiredVisitor')->group(function () {
    Route::get('/home', [VisitorMapping::class, 'index'])->name('home');
    Route::get('/view-artifact/{qr}', [VisitorViewController::class, 'index']);

    //* ============================================ FEEDBACKS ==== >>

    Route::get('/feedback-fil', [FeedbackController::class, 'index']);
    Route::get('/feedback-en', [FeedbackController::class, 'indexEn']);
    Route::post('/feedback-create', [FeedbackController::class, 'create'])->name('feedback');


    //* ============================================ Visitor Mapping ==== >>

    Route::get('/visitor-mapping/significant-natural-resources', Snr::class)->name('snr');
    Route::get('/visitor-mapping/tangible-immovable-cultural-heritage', Immovable::class)->name('immovable');
    Route::get('/visitor-mapping/tangible-movable-cultural-heritage', Movable::class)->name('movable');
    Route::get('/visitor-mapping/intangible-cultural-heritage', Intangible::class)->name('intangible');
    Route::get('/visitor-mapping/significant-personalities', SignificantPersonalities::class)->name('significant.personalities');
    Route::get('/visitor-mapping/cultural-institutions', Cultural::class)->name('cultural');


    //SNR
    Route::get('/bodies-of-water/{id}', [VisitorMapping::class, 'showBodiesOfWater'])->name('bow.details');
    Route::get('/plants/{id}', [VisitorMapping::class, 'showFauna'])->name('plants.details');
    Route::get('/animals/{id}', [VisitorMapping::class, 'showAnimal'])->name('animals.details');
    Route::get('/critical/{id}', [VisitorMapping::class, 'showCritical'])->name('critical.details');
    Route::get('/protected/{id}', [VisitorMapping::class, 'showProtected'])->name('protected.details');

    //IMMOVABLE
    Route::get('/government/{id}', [VisitorMapping::class, 'showGovernment'])->name('government.details');
    Route::get('/sites/{id}', [VisitorMapping::class, 'showSites'])->name('sites.details');
    Route::get('/house/{id}', [VisitorMapping::class, 'showHouse'])->name('house.details');

    //MOVABLE
    Route::get('/ethnographic-object/{id}', [VisitorMapping::class, 'showEthnographic'])->name('ethno.details');
    Route::get('/archival-holdings/{id}', [VisitorMapping::class, 'showArchival'])->name('archival.details');

    // INTANGIBLE
    Route::get('/social-practices/{id}', [VisitorMapping::class, 'showSocialPractices'])->name('social.practices.details');
    Route::get('/knowledge-and-practices/{id}', [VisitorMapping::class, 'showKnowledgePrac'])->name('knowledge.details');
    Route::get('/traditional-craftsmanship/{id}', [VisitorMapping::class, 'showTraditionalCraftsmanship'])->name('traditional.craftsmanship.details');
    Route::get('/oral-tradition/{id}', [VisitorMapping::class, 'showOralTradition'])->name('oral.tradition.details');

    // SIGNIFICANT PERSONALITIES
    Route::get('/significant-personalities/{id}', [VisitorMapping::class, 'showSignificantPersonalities'])->name('personalities.details');

    // CULTURAL INSTITUTIONS
    Route::get('/Cultural-Institutions/{id}', [VisitorMapping::class, 'showCulturalIns'])->name('cul.ins.details');

});


Route::get('/email-validation', EmailValidation::class)->name('email.validation');
Route::get('/visitor-login', App\Livewire\Visitor\VisitorLogin::class);

Route::get('/returning-visitor-form/{id}', [VisitorForm::class, 'edit'])->name('returning.visitor.form')->middleware('signed');
Route::put('/returning-visitor-form/update/{id}', [VisitorForm::class, 'update'])->name('returning.visitor.form.update');

Route::get('/visitor-form', [VisitorForm::class, 'index'])->name('visitor.form');
Route::post('/visitor-form/store', [VisitorForm::class, 'store'])->name('visitor');

Route::post('/get-cities', [VisitorForm::class, 'getCities'])->name('get.cities');
Route::post('/get-barangays', [VisitorForm::class, 'getBarangays'])->name('get.barangays');

//* ============================================ Browser Shots ==== >>
Route::get('/visitorqr', [Qrcode::class, 'visitorQr'])->name('visitorqr');
