<?php


use App\Livewire\Sales\Applications\ViewApplication;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Notification;
use App\Livewire\Other\Branch\BranchList;
use App\Livewire\Other\Co\CoList;
use App\Livewire\Other\MFI\MFIList;
use App\Livewire\Other\Occupation\OccupationList;
use App\Livewire\Other\Product\ProductList;
use App\Livewire\Other\SaleChannels\SaleChannelList;
use App\Livewire\Other\Shop\ShopList;

use App\Livewire\Report\SalePerformanceByChannel;
use App\Livewire\Report\SaleSummaryByCompany;
use App\Livewire\Report\SaleSummaryReport;
use App\Livewire\Report\ShopPeformanceReport;
use App\Livewire\Report\TotalSaleSummaryReport;
use App\Livewire\Sales\Applications\ApplicationList;
use App\Livewire\Sales\Applications\ApplicationStatus;
use App\Livewire\Sales\Applications\Create as ApplicationsCreate;
use App\Livewire\Sales\Applications\ImportFileApplication;
use App\Livewire\Sales\Applications\Update as ApplicationsUpdate;
use App\Livewire\Sales\Customers\CreateCustomer;
use App\Livewire\Sales\Customers\Customerlist;
use App\Livewire\Sales\Customers\UpdateCustomer;
use App\Livewire\Sales\Discard\DiscardList;
use App\Livewire\Sales\Pending\PendingList;
use App\Livewire\Sales\Sale\Preview;
use App\Livewire\Sales\Sale\SaleList;
use App\Livewire\Sales\SaleChannelTargets\SaleChannelTargetDetails;
use App\Livewire\Sales\SaleChannelTargets\SaleChannelTargetList;
use App\Livewire\Sales\SaleTargetByShop\SaleTargetByShop;
use App\Livewire\Sales\SaleTargetByShop\SaleTargetByShopList;
use App\Livewire\Setting\ManageSetting;
use App\Livewire\Users\Role\RoleApplyPermission;
use App\Livewire\Users\Role\RoleList;
use App\Livewire\Users\Staff\StaffList;
use App\Livewire\Users\Staff\UserProfile;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::GET('/user-profile/{id}', UserProfile::class)->name('user-profile');
Route::GET('/login', Login::class)->name('login');
Route::middleware('auth', 'route_permission')->group(function () {

  Route::GET('/user/role-apply-permission/{role_id}', RoleApplyPermission::class)->name('user.role.apply_permission');
  Route::GET('/', Dashboard::class)->name('dashboard');
  Route::GET('/user/list', StaffList::class)->name('user-list');
  Route::GET('/user/role', RoleList::class)->name('role-list');
  Route::GET('/user/role/role-apply-permission/{role_id}', RoleApplyPermission::class)->name('role.apply_permission');
  Route::GET('/sale/application', ApplicationList::class)->name('application.list');
  Route::GET('/sale/list', SaleList::class)->name('sale.list');

  Route::GET('/sale/customer', Customerlist::class)->name('customer-list');
  Route::GET('/sale/customer/create', CreateCustomer::class)->name('customer-create');
  Route::GET('/sale/customer/update/{customerId}', UpdateCustomer::class)->name('customer-update');
  Route::GET('/sale/application/import', ImportFileApplication::class)->name('sale.import');
  Route::GET('/sale/application/create', ApplicationsCreate::class)->name('application.create');
  Route::POST('/sale/applciation/create-status/{id}', ApplicationStatus::class)->name("application.create-status");
  Route::GET('/sale/application/application-update/{id}', ApplicationsUpdate::class)->name('application.update');
  Route::GET('/sale/application/application-view/{id}', ViewApplication::class)->name('application-view');
  Route::get('sales/preview', Preview::class)->name('sale.preview');
  // Route::GET('/sale/sale_channel_target', SaleChannelTargetList::class)->name('sale_channel_target');
  Route::GET('/sale/sale_target_by_shop', SaleTargetByShopList::class)->name('sale_target_by_shop');

  // Route::get('/sale/sale_target_by_shop', SaleChannelTargetList::class )->name('sale_target_by_shop');
  Route::GET('/sale/pending/list', PendingList::class)->name('pending-list');
  Route::GET('/sale/discard/list', DiscardList::class)->name('discard-list');

  Route::GET('/report/sale-summary-report', SaleSummaryByCompany::class)->name('sale-summary-report');
  Route::GET('/report/sale-performance-by-channel', SalePerformanceByChannel::class)->name('report.sale-performance-by-channel');
  Route::GET('/report/total-sale-report', TotalSaleSummaryReport::class)->name('total-sale-report');
  Route::GET('/report/shop-performance-report', ShopPeformanceReport::class)->name('sale-performance-report');
  Route::GET('/setting/{slug}', ManageSetting::class)->name('setting.language');
  Route::GET('/notification/{notification_ref}', Notification::class)->name('notification');

  Route::prefix('manage')->group(function () {
    Route::GET('/shop', ShopList::class)->name('shop-list');
    Route::GET('/product', ProductList::class)->name('product-list');
    Route::GET('/co', CoList::class)->name('co-list');
    Route::GET('/loan_company', MFIList::class)->name('mfi-list');
    Route::GET('/occupation', OccupationList::class)->name('occupation-list');
    Route::GET('/branch', BranchList::class)->name('branch.ist');
    Route::GET('/sale-channel', SaleChannelList::class)->name('sale-channel-list');
  });
});
