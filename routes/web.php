<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\DatePickerExample;

// Management
use App\Livewire\Management\Branches\BranchList;
use App\Livewire\Management\Brands\BrandList;
use App\Livewire\Management\Categories\CategoryList;
use App\Livewire\Management\Customers\CustomerList;
use App\Livewire\Management\Expenses\ExpenseList;
use App\Livewire\Management\Payments\PaymentList;
use App\Livewire\Management\Products\ProductList;
use App\Livewire\Management\Purchases\PurchaseList;
use App\Livewire\Management\Sales\SaleList;
use App\Livewire\Management\StockMovements\StockMovementList;
use App\Livewire\Management\Suppliers\SupplierList;
use App\Livewire\Management\Units\UnitList;

// Users
use App\Livewire\Users\ListUser;
use App\Livewire\Users\Role\RoleList;
use App\Livewire\Users\Role\RoleApplyPermission;

// POS
use App\Livewire\POS\PosSystem;

// Settings
use App\Livewire\Setting\ManageSetting;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('datepicker', DatePickerExample::class);
Route::get('/login', Login::class)->name('login');

/*
|--------------------------------------------------------------------------
| Protected Routes (with middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'route_permission', 'prevent_session_isvalid', 'check_permission'])->group(function () {

    // Dashboard
    Route::get('/', Dashboard::class)->name('dashboard');

    // Users
    Route::prefix('user')->group(function () {
        Route::get('/list', ListUser::class)->name('user-list');
        Route::get('/role', RoleList::class)->name('role-list');
        Route::get('/role/role-apply-permission/{role_id}', RoleApplyPermission::class)
            ->name('role.apply_permission');
    });

    // POS System
    Route::prefix('pos-system')->name('pos-system.')->group(function () {

        // Main POS page
        Route::get('/pos', PosSystem::class)->name('pos');

        // Receipt printing
        Route::get('/receipt/print/{id}', function ($id) {
            $sale = \App\Models\Sale::with(['items.product', 'branch', 'customer', 'user'])->findOrFail($id);
            return view('livewire.p-o-s.receipt', compact('sale'));
        })->name('receipt.print');

    });

    // Management
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
        Route::get('/payments', PaymentList::class)->name('manage.payments');
        Route::get('/expenses', ExpenseList::class)->name('manage.expenses');
        Route::get('/sale', SaleList::class)->name('manage.sale');
    });

    // Reports (placeholder)
    Route::prefix('report')->group(function () { });

    // Settings
    Route::get('/setting', ManageSetting::class)->name('manage-setting');

    // Fallback 404
    Route::fallback(function () {
        return view('livewire.errors.404');
    });

});