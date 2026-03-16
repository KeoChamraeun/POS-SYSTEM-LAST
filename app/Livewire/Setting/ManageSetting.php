<?php

namespace App\Livewire\Setting;

use App\Models\ExchangeRate;
use App\Models\TransactionLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageSetting extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $index = 0;
    public $limit = 15;
    public $sort = 'desc';
    public $sortField = 'id';
    public $start_date;
    public $end_date;
    public $search = '';
    public $theme;
    protected string $paginationTheme = 'bootstrap';
    public $lang;

    public $username;
    public $password;
    public $id;
    public $first;
    public $last;
    public $profileImg;
    public $khr = 0;

    protected $messages = [
        'username.required' => 'Please enter a username.',
        'username.min' => 'Username must be at least 5 characters.',
        'username.unique' => 'This username is already taken.',
    ];
    protected $listeners = ['setTheme'];
    public $localTheme;

    public function setTheme($theme)
    {
        $this->localTheme = $theme;
    }

    public function toggleTheme($mode)
    {
        if ($this->theme == $mode) {
            return;
        }

        $this->theme = $mode;
        $this->dispatch('toggle-theme', theme: $this->theme);
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: $mode == 'light' ? __('Light mode is active!') : __('Dark mode is active!')
        );
    }

    public function switchLanguage($lang)
    {
        Session::put('locale', $lang);
        App::setLocale($lang);
        $currentUrl = url()->previous();
        $this->redirect($currentUrl, navigate: false);
        $this->dispatch('languageChanged');
    }

    public function orderBy($field, $order)
    {
        $this->sortField = $field;
        $this->sort = $order;
    }

    public function mount()
    {
        $this->start_date = Carbon::now()->toDateString();
        $this->end_date = Carbon::now()->toDateString();
        $this->getAuth();
    }

    public function getAuth()
    {
        $this->id = Auth::user()->id;
        $auth = User::findOrFail($this->id);
        $this->username = $auth->username;
        $nameParts = explode(' ', trim($auth->name));
        $this->first = $nameParts[0] ?? '';
        $this->last = $nameParts[1] ?? '';
        $this->password = '********';
    }

    public function updateUsername()
    {
        $this->validate(['username' => 'required|min:5|unique:users,username,'.Auth::id()]);
        $user = User::find($this->id);
        $user->username = $this->username;
        create_transaction_log('Auth', 'Auth', $this->username.' has been changed by '.Auth::user()->name, Auth::user()->name);
        $user->save();
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: __('Username has been updated successfully!')
        );
    }

    public function updateProfile()
    {
        $this->validate([
            'first' => 'required|string',
            'last' => 'required|string',
            'profileImg' => 'nullable|image',
        ]);
        $path = null;
        try {
            $user = User::find($this->id);
            $user->name = $this->first.' '.$this->last;
            if ($this->profileImg) {
                if ($user->profile && Storage::disk('public')->exists($user->profile)) {
                    Storage::disk('public')->delete($user->profile);
                }

                $path = $this->profileImg->store('photos', 'public');
                $user->profile = $path;
            }

            $user->save();

            create_transaction_log(
                'Auth', 'Profile Update', $user->name.' updated profile successfully!', Auth::user()->name);
            $this->dispatch(
                'show-toast',
                type: 'success',
                message: __('Profile has been updated successfully!')
            );
        } catch (\Exception $e) {
            $this->dispatch(
                'show-toast',
                type: 'error',
                message: __('An error occurred while updating the user.')
            );
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->intended('login');
    }

    public function delete()
    {
        $this->dispatch(
            'show-toast',
            type: 'warning',
            message: __('This function is currently not working as intended.')
        );
    }

    public function openChanePassword()
    {
        $this->dispatch('modal.openModal');
    }

    public function changeExchangeRate()
    {
        $this->validate(['khr' => 'required|int']);

        $exchange = new ExchangeRate();
        $exchange->price = 1;
        $exchange->rate = $this->khr;
        create_transaction_log('Exchange Rate', 'Exchange Rate', 'Exchange Rate has changed successfully!', Auth::user()->name);
        $exchange->save();
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: __('Exchange Rate has changed successfully!')
        );
    }

    public function render()
    {
        $systemLogs = TransactionLog::whereBetween('created_at', [$this->start_date.' 00:00:00', $this->end_date.' 23:59:59'])
        ->orderBy($this->sortField, $this->sort);

        if ($this->search) {
            $systemLogs = $systemLogs->where('action', 'ilike', '%'.$this->search.'%')
            ->orWhere('description', 'ilike', '%'.$this->search.'$')
            ->orWhere('created_by_user', 'ilike', '%'.$this->search.'%');
        }

        $systemLogs = $systemLogs->paginate($this->limit);

        $exchangeRate = ExchangeRate::orderBy('id', 'desc');
        $exchangeRate = ExchangeRate::orderBy('id', 'desc')
        ->paginate($this->limit);

        return view('livewire.setting.manage-setting', [
            'systemLogs' => $systemLogs,  'exchangeRate' => $exchangeRate,
        ])->title('Fixed Assets | Settings');
    }
}
