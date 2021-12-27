<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Artisan;
use Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.settting.general');
    }

    public function GeneralUpdate(Request $request)
    {
        $request->validate([
            'site_title'       => 'required|string|min:2|max:255',
            'site_description' => 'nullable|string|min:2|max:255',
            'site_address'     => 'nullable|string|min:2|max:255',
        ]);

        Setting::updateOrCreate(['name' => 'site_title'],['value'=> $request->get('site_title')]);
        // update .env
        Artisan::call("env:set APP_NAME='". $request->site_title ."'");
        Setting::updateOrCreate(['name' => 'site_description'],['value'=> $request->get('site_description')]);
        Setting::updateOrCreate(['name' => 'site_address'],['value'=> $request->get('site_address')]);

        notify()->success('Setting Updated', "Success");
        return redirect()->back();
    }

    public function Apearance()
    {
         return view('backend.settting.apearance');
    }

    public function ApearanceUpdate(Request $request)
    {
        $request->validate([
            'site_logo'    => 'nullable|image',
            'site_favicon'    => 'nullable|image',
        ]);

        // upload logo

        if ($request->hasfile('site_logo')) {
            $this->deleteOldImage(setting('site_logo'));
             Setting::updateOrCreate(
            ['name'    => 'site_logo'],
            [
                'value'  => Storage::disk('public')->putFile('logo', $request->file('site_logo'))
            ]
        );

        }
        
          // upload favicon


          if ($request->hasfile('site_favicon')) {
            $this->deleteOldImage(setting('site_favicon'));
             Setting::updateOrCreate(
            ['name'    => 'site_favicon'],
            [
                'value'  => Storage::disk('public')->putFile('logo', $request->file('site_favicon'))
            ]
        );

        }
         notify()->success('Logo Updated', "Success");
        return redirect()->back();

       
    }

    private function deleteOldImage($path)
    {
        Storage::disk('public')->delete($path);
    }


    public function Mail()
    {
        return view('backend.settting.mail');
    }

    public function MailUpdate(Request $request)
    {
        $request->validate([
            'mail_mailer'        => 'string|max:255',
            'mail_encryption'    => 'nullable|string|max:255',
            'mail_host'          => 'nullable|string|max:255',
            'mail_port'          => 'nullable|string|max:255',
            'mail_username'      => 'nullable|string|max:255',
            'mail_password'      => 'nullable|string|max:255',
            'mail_from_address'  => 'nullable|email|max:255',
            'mail_from_name'     => 'nullable|string|max:255',
 
        ]);

        Setting::updateOrCreate(['name' => 'mail_mailer'],['value'=> $request->get('mail_mailer')]);
        // update .env
        Artisan::call("env:set MAIL_MAILER='". $request->mail_mailer ."'");


        Setting::updateOrCreate(['name' => 'mail_host'],['value'=> $request->get('mail_host')]);
        // update .env
        Artisan::call("env:set MAIL_HOST='". $request->mail_host ."'");


        Setting::updateOrCreate(['name' => 'mail_port'],['value'=> $request->get('mail_port')]);
        // update .env
        Artisan::call("env:set MAIL_PORT='". $request->mail_port ."'");


         Setting::updateOrCreate(['name' => 'mail_username'],['value'=> $request->get('mail_username')]);
        // update .env
        Artisan::call("env:set MAIL_USERNAME='". $request->mail_username ."'");


         Setting::updateOrCreate(['name' => 'mail_password'],['value'=> $request->get('mail_password')]);
        // update .env
        Artisan::call("env:set MAIL_PASSWORD='". $request->mail_password ."'");


        Setting::updateOrCreate(['name' => 'mail_encryption'],['value'=> $request->get('mail_encryption')]);
        // update .env
        Artisan::call("env:set MAIL_ENCRYPTION='". $request->mail_encryption ."'");


        Setting::updateOrCreate(['name' => 'mail_from_address'],['value'=> $request->get('mail_from_address')]);
        // update .env
        Artisan::call("env:set MAIL_FROM_ADDRESS='". $request->mail_from_address ."'");

        Setting::updateOrCreate(['name' => 'mail_from_name'],['value'=> $request->get('mail_from_name')]);
        // update .env
        Artisan::call("env:set MAIL_FROM_NAME='". $request->mail_from_name ."'");


        notify()->success('Mail Setting Updated', "Success");
        return redirect()->back();
    }


     public function Socialite()
    {
        return view('backend.settting.socialite');
    }


     public function SocialiteUpdate(Request $request)
    {
        $request->validate([
            'githup_client_id'          => 'nullable|string|min:2|max:255',
            'githup_client_secret'      => 'nullable|string|min:2|max:255',
            'google_client_id'          => 'nullable|string|min:2|max:255',
            'google_client_secret'      => 'nullable|string|min:2|max:255',
            'facebook_client_id'        => 'nullable|string|min:2|max:255',
            'facebook_client_secret'    => 'nullable|string|min:2|max:255',
 
        ]);

        Setting::updateOrCreate(['name' => 'githup_client_id'],['value'=> $request->get('githup_client_id')]);
        // update .env
        Artisan::call("env:set GITHUB_CLIENT_ID='". $request->githup_client_id ."'");


        Setting::updateOrCreate(['name' => 'githup_client_secret'],['value'=> $request->get('githup_client_secret')]);
        // update .env
        Artisan::call("env:set GITHUB_CLIENT_SECRET='". $request->githup_client_secret ."'");


        Setting::updateOrCreate(['name' => 'google_client_id'],['value'=> $request->get('google_client_id')]);
        // update .env
        Artisan::call("env:set GOOGLE_CLIENT_ID='". $request->google_client_id ."'");


         Setting::updateOrCreate(['name' => 'google_client_secret'],['value'=> $request->get('google_client_secret')]);
        // update .env
        Artisan::call("env:set GOOGLE_CLIENT_SECRET='". $request->google_client_secret ."'");


         Setting::updateOrCreate(['name' => 'facebook_client_id'],['value'=> $request->get('facebook_client_id')]);
        // update .env
        Artisan::call("env:set FACEBOOK_CLIENT_ID='". $request->facebook_client_id ."'");


        Setting::updateOrCreate(['name' => 'facebook_client_secret'],['value'=> $request->get('facebook_client_secret')]);
        // update .env
        Artisan::call("env:set FACEBOOK_CLIENT_SECRET='". $request->facebook_client_secret ."'");


        notify()->success('Socialite Setting Updated', "Success");
        return redirect()->back();
    }



}
