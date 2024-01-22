<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;
use App\Http\Requests\ConfigFormRequest;
use Illuminate\Support\Facades\File;
use DB;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('admin.config.index', \compact('config'));
    }

    public function update(ConfigFormRequest $request)
    {
        $currency = explode(' ',trim($request->input('currency')));
        $currency_simbol = ucwords($currency[1]);

        $config = Config::first();
        if($request->hasFile('logo'))
        {
            $path = 'assets/uploads/logos/'.$config->logo;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/logos/',$filename);
            $config->logo = $filename;
        }
        if($request->hasFile('contract'))
        {
            $path1 = 'assets/uploads/contract/'.$config->contract;
            if(File::exists($path1))
            {
                File::delete($path1);
            }
            $file1 = $request->file('contract');
            $ext1 = $file1->getClientOriginalExtension();
            $filename1 = time().'.'.$ext1;
            $file1->move('assets/uploads/contract/',$filename1);
            $config->contract = $filename1;
        }
        $config->payments_description = $request->input('payments_description');
        $config->registration_process = $request->input('registration_process');
        $config->currency = $request->input('currency');
        $config->currency_simbol = $currency_simbol;
        $config->email = $request->input('email');
        $config->tax_status = $request->input('tax_status') == TRUE ? '1':'0';
        $config->tax = $request->input('tax');
        $config->paypal = $request->input('paypal') == TRUE ? '1':'0';
        $config->dbt = $request->input('dbt') == TRUE ? '1':'0';
        $config->shipping_description = $request->input('shipping_description');
        $config->fb_link = $request->input('fb_link');
        $config->inst_link = $request->input('inst_link');
        $config->yt_link = $request->input('yt_link');
        $config->wapp_link = $request->input('wapp_link');
        $config->update();

        $request->session()->flash('alert-success', __('Settings updated correctly'));

        return view('admin.config.index', \compact('config'));
    }
}
