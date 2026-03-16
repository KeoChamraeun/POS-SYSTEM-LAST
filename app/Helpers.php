<?php

use App\Models\Role;
use App\Models\TransactionLog;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

// $khNUMTxt = array('', 'មួយ', 'ពីរ', 'បី', 'បួន', 'ប្រាំ');
// $twoLetter = array('', 'ដប់', 'ម្ភៃ', 'សាមសិប', 'សែសិប', 'ហាសិប', 'ហុកសិប', 'ចិតសិប', 'ប៉ែតសិប', 'កៅសិប');
// $khNUMLev = array('', '', '', 'រយ', 'ពាន់', 'មឿន', 'សែន', 'លាន');
// $khnum = array('០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩');
define('tb_header_color', [
    'primary' => '#007bff',
    'secondary' => '#6c757d',
    'success' => '#28a745',
    'danger' => '#dc3545',
    'warning' => '#ffc107',
    'info' => '#17a2b8',
    'light' => '#f8f9fa',
    'dark' => '#343a40',
    'base' => '#cfe2ff',
]);
define('text_color', [
    'primary' => '#007bff',
    'secondary' => '#6c757d',
    'success' => '#28a745',
    'danger' => '#dc3545',
    'warning' => '#ffc107',
    'info' => '#17a2b8',
    'light' => '#f8f9fa',
    'dark' => '#343a40',
    'silver' => '#c0c0c0',
    'bronz' => '#d7d5d5',
]);

define('GET_DENIED_MESSAGE', 'Access Denied! You don\'t have permission to access this function. Request access from your administrator');
define('NO_RECORD_FOUND', 'No record found...!');

if (!function_exists('label_translation')) {
    function label_translation($item)
    {
        if ($item) {
            if (App::getLocale('locale') == 'en') {
                return $item->name != null ? $item->name : $item->name_translate;
            } else {
                return $item->name_translate != null ? $item->name_translate : $item->name;
            }
        }
    }
}
if (!function_exists('reason_translation')) {
    function reason_translation($app)
    {
        $lastActivity = optional($app->application_activity)->last();
        if (!$lastActivity) {
            return null;
        }
        $reason = optional($lastActivity)->reason;
        if ($reason) {
            return App::getLocale() === 'en'
                ? ($reason->name ?? $reason->name_translate)
                : ($reason->name_translate ?? $reason->name);
        }

        return $lastActivity->description ?? null;
    }
}

if (!function_exists('type_translation')) {
    function type_translation($application)
    {
        if ($application->loanType) {
            if (App::getLocale('locale') == 'en') {
                return $application->loanType->name != null ? $application->loanType->name : $application->loanType->name_translate;
            } else {
                return $application->loanType->name_translate != null ? $application->loanType->name_translate : $application->name;
            }
        }
    }
}

if (!function_exists('loan_report_translation')) {
    function loan_report_translation($item)
    {
        if ($item->loanType) {
            if (App::getLocale('locale') == 'en') {
                return $item->loanType->name != null ? $item->loanType->name : $item->loanType->name_translate;
            } else {
                return $item->loanType->name_translate != null ? $item->loanType->name_translate : $item->name;
            }
        }
    }
}

if (!function_exists('loan_type_translation')) {
    function loan_type_translation($branch_tag)
    {
        if ($branch_tag->application->loanType) {
            if (App::getLocale('locale') == 'en') {
                return $branch_tag->application->loanType->name != null ? $branch_tag->application->loanType->name : $branch_tag->application->loanType->name_translate;
            } else {
                return $branch_tag->application->loanType->name_translate != null ? $branch_tag->application->loanType->name_translate : $branch_tag->application->name;
            }
        }
    }
}

if (!function_exists('loan_translation')) {
    function loan_translation($application)
    {
        if ($application) {
            if (App::getLocale('locale') == 'en') {
                return $application->name;
            } else {
                return $application->name_translate;
            }
        }
    }
}
if (!function_exists('client_translation')) {
    function client_translation($application)
    {
        if ($application) {
            if (App::getLocale('locale') == 'en') {
                return $application->customer_name != null ? $application->customer_name : $application->customer_name_translate;
            } else {
                return $application->customer_name_translate;
            }
        }
    }
}
if (!function_exists('guarantor_translation')) {
    function guarantor_translation($item)
    {
        if ($item) {
            if (App::getLocale('locale') == 'en') {
                return $item->guarantor_name;
            } else {
                return $item->guarantor_name_translate;
            }
        }
    }
}

if (!function_exists('supplier_translation')) {
    function supplier_translation($item)
    {
        if ($item) {
            if (App::getLocale('locale') == 'en') {
                return $item->full_name;
            } else {
                return $item->full_name_translate;
            }
        }
    }
}

if (!function_exists('product_translation')) {
    function product_translation($item)
    {
        if ($item) {
            if (App::getLocale('locale') == 'en') {
                return $item->title;
            } else {
                return $item->title_translate;
            }
        }
    }
}

if (!function_exists('get_money')) {
    function get_money($money)
    {
        return '$ '.number_format($money, 2) ?? 0;
    }
}
if (!function_exists('get_money_khr')) {
    function get_money_khr($money)
    {
        return '៛ '.number_format($money, 2) ?? 0;
    }
}

if (!function_exists('get_translation')) {
    function get_translation($item)
    {
        if (!$item) {
            return '';
        }
        if (App::getLocale('locale') == 'en') {
            return $item->name ?? '';
        } else {
            $lang = json_decode($item->languages, true);

            return $lang['name'] ?? '';
        }
    }
}

if (!function_exists('staff_profile')) {
    function staff_profile($file_name)
    {
        if ($file_name == null) {
            return asset('/assets/icon/profile-gray.png');
        } else {
            return asset($file_name);
        }
    }
}

if (!function_exists('check_user_exist')) {
    function check_user_exist($column, $value)
    {
        return User::where($column, $value)->first();
    }
}

if (!function_exists('check_role_name_exist')) {
    function check_role_name_exist($column, $value)
    {
        return Role::where($column, $value)->first();
    }
}

if (!function_exists('create_transaction_log')) {
    function create_transaction_log($action, $type, $desc, $reference)
    {
        $action_log = new TransactionLog();
        $action_log->action = $action;
        $action_log->type = $type;
        $action_log->description = $desc;
        $action_log->reference = $reference;
        $action_log->created_by_user = Auth::user()->name;
        $action_log->user_id = Auth::id();
        $action_log->save();
    }
}
