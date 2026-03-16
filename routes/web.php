<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\DatePickerExample;
use App\Livewire\Management\Branches\BranchList;
use App\Livewire\Management\Brands\BrandList;
use App\Livewire\Management\Categories\CategoryList;
use App\Livewire\Management\Customers\CustomerList;
use App\Livewire\Management\Expenses\ExpenseList;
use App\Livewire\Management\Payments\PaymentList;
use App\Livewire\Management\Products\ProductList;
use App\Livewire\Management\Purchases\PurchaseList;
use App\Livewire\Management\Sales\SaleList;
use App\Livewire\Management\Staffs\StaffList;
use App\Livewire\Management\StockMovements\StockMovementList;
use App\Livewire\Management\Suppliers\SupplierList;
use App\Livewire\Management\Units\UnitList;
use App\Livewire\Setting\ManageSetting;
use App\Livewire\Users\ListUser;
use App\Livewire\Users\Role\RoleApplyPermission;
use App\Livewire\Users\Role\RoleList;
use App\Models\Brand;
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
        Route::get('/branches', BranchList::class)->name('manage.branches');
        Route::get('/categories', CategoryList::class)->name('manage.categories');
        Route::get('/stock-movement', StockMovementList::class)->name('manage.stock-movement');
        Route::get('/brands', BrandList::class)->name('manage.brands');
        Route::get('/units', UnitList::class)->name('manage.units');
        Route::get('/products', ProductList::class)->name('manage.products');
        Route::get('/customers', CustomerList::class)->name('manage.customers');
        Route::get('/suppliers', SupplierList::class)->name('manage.suppliers');
        Route::get('/purchases', PurchaseList::class)->name('manage.purchases');
        Route::get('/sale', SaleList::class)->name('manage.sale');
        Route::get('/payments', PaymentList::class)->name('manage.payments');
        Route::get('/expenses', ExpenseList::class)->name('manage.expenses');

    });

    Route::prefix('report')->group(function () {
    });

    Route::Get('/setting', ManageSetting::class)->name('manage-setting');

    Route::fallback(function () {
        return view('livewire.errors.404');
    });
});
