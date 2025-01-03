<?php

namespace App\Filament\Auth;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseAuth;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;

class Login extends BaseAuth
{
    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        if (env('ALLOW_FORM_LOGIN', false)) {
            return [
                'form' => $this->form(
                    $this->makeForm()
                        ->schema([
                            $this->getEmailFormComponent(),
                            $this->getPasswordFormComponent(),
                            $this->getRememberFormComponent(),
                        ])
                        ->statePath('data'),
                ),
            ];
        }

        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([])
                    ->statePath('data'),
            ),
        ];
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        if (env('ALLOW_FORM_LOGIN', false)) {
            return [
                $this->getAuthenticateFormAction(),
                $this->getGoogleAuthAction(),
            ];
        }

        return [
            $this->getGoogleAuthAction(),
        ];
    }

    protected function getGoogleAuthAction(): Action
    {
        return Action::make('google-auth')
            ->label('Google Sign In')
            ->url('/auth/google');
    }

    public function getHeading(): string|Htmlable
    {

        return new HtmlString('
            <div class="flex items-center flex-col pt-4">
                <h1 class="text-2xl font-normal">Welcome Back!</h1>
                <!-- <img class="pt-4" src="'.asset('images/blogo.png').'" alt="BIT Sathy"> -->
                '.
                (
                    Session::has('error') ?
                        '<h5 class="text-danger-600 dark:text-danger-400 text-base font-normal pt-4">'.Session::get('error').'</h5>'
                        : ''
                )
                .'
            </div>
            <!-- Script to set default theme to dark -->
            <!-- <script>
                localStorage.setItem("theme", "dark");
            </script> -->
        ');
    }
}
