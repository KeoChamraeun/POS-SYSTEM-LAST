<?php

use App\Livewire\Accounting\ChartofAccount\AccountList;
use App\Livewire\Accounting\FixedAssets\CreateFixedAsset;
use App\Livewire\Accounting\FixedAssets\FixedAssetList;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\DatePickerExample;
use App\Livewire\Management\Brands\BrandList;
use App\Livewire\Management\Company\CompanyList;
use App\Livewire\Management\Department\DepartmentList;
use App\Livewire\Management\Position\PosistionList;
use App\Livewire\Management\Products\ProductList;
use App\Livewire\Management\Staffs\StaffList;
use App\Livewire\Management\Suppliers\SupplierList;
use App\Livewire\Reports\ConsolidateFixedAsset;
use App\Livewire\Reports\PurchaseExpendable;
use App\Livewire\Reports\SummaryFixedAssets;
use App\Livewire\Reports\TaxLawDepreciation;
use App\Livewire\Setting\ManageSetting;
use App\Livewire\Users\ListUser;
use App\Livewire\Users\Role\RoleApplyPermission;
use App\Livewire\Users\Role\RoleList;
use Illuminate\Support\Facades\Route;

Route::get('datepicker', DatePickerExample::class);

Route::GET('/login', Login::class)->name('login');
Route::middleware('auth', 'route_permission', 'prevent_session_isvalid', 'check_permission')->group(function () {
    Route::GET('/', Dashboard::class)->name('dashboard');

    Route::prefix('user')->group(function () {
        Route::GET('/list', ListUser::class)->name('user-list');
        Route::GET('/role', RoleList::class)->name('role-list');
        Route::GET('/role/role-apply-permission/{role_id}', RoleApplyPermission::class)->name('role.apply_permission');
    });


    Route::prefix('manage')->group(function () {
    });

    Route::prefix('report')->group(function () {
    });

    Route::Get('/setting', ManageSetting::class)->name('manage-setting');

    Route::fallback(function () {
        return view('livewire.errors.404');
    });
});
