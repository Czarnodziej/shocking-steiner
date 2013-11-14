<?php namespace App\Controllers\User;
use Auth, BaseController, Form, Input, Redirect, Sentry, View, Notification;

class AuthController extends BaseController {

//login functions

    public function getLogin()
    {
        return View::make('user.auth.login');
    }

    public function postLogin()
    {
        $credentials = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password')
            );

        try
        {
            $user = Sentry::authenticate($credentials, false);

            if ($user)
            {
                return Redirect::route('użytkownik.teksty.index');
            }
        }

        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $error = 'Adres e-mail jest wymagany.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $error ='Hasło jest wymagane.';
        }

        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $error ='Użytkownik nie jest zarejestrowany lub informacje logowania są nieprawidłowe.';
        }

        catch(\Exception $e)
        {
            $error = $e->getMessage();
        }
        return Redirect::route('user.login')->withErrors(array('login' => $error));
    }

    public function getLogout()
    {
        Sentry::logout();

        return Redirect::route('article.list');
    }

//User registration

    public function getRegister()
    {
        return View::make('user.auth.register');
    }

    public function postRegister()
    {
        $credentials = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password')
            );

        try
        {
            //"true" argument = no activation needed
            $user = Sentry::register($credentials, true);

            // Find the group using the group id
            $userGroup = Sentry::findGroupById(2);

            // Assign the group to the user
            $user->addGroup($userGroup);

            Notification::success('Konto użytkownika utworzone pomyślnie. Można się zalogować.');
            return Redirect::route('user.login');

        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $error = 'Adres e-mail jest wymagany.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $error ='Hasło jest wymagane.';
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $error = 'Użytkownik o takiej nazwie jest już zarejestrowany. Wybierz inną.';
        }

        catch(\Exception $e)
        {
            $error = $e->getMessage();
        }

        return Redirect::route('user.register')->withErrors(array('register' => $error));
    }


}