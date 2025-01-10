<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    // ---------------------------------------------------- admin
    public function MGeneral(): Response
    {
        $potential = DB::table('potential')
            ->where('id_manage', '1')
            ->get();

        $banner = DB::table('banner_images')
            ->where('status_dul', '1')
            ->get();

        return Inertia::render('Admin/ManageGeneral/General_home', ['potentialdb' => $potential, 'banners' => $banner]);
    }

    public function MGeneral_edit(Request $request): RedirectResponse
    {
        DB::table('potential')->where('id', $request->id)->update(
            [
                'quantity' => $request->quantity,
            ]
        );
        return Redirect::route('Manage.MGeneral');
    }

    public function MGeneral_banner_create(Request $request): RedirectResponse
    {
        // dd($request);
        $urlimage = 'http://127.0.0.1:8000/storage/images/banner/';
        // $urlimage = 'http://localhost/storage/images/banner/';
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/banner/';
        if ($request->hasFile('News_title_image')) {
            $file = $request->file('News_title_image');
            $exten = $file->getClientOriginalExtension();
            $filename = "banner" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/banner', $filename);

            $refilename = $urlimage . $filename;
        } else {
            $refilename = null;
        }

        DB::table('banner_images')->insert(
            [
                'image' => $refilename,
                'status_dul' => 1,
            ]
        );
        return Redirect::route('Manage.MGeneral');
    }
}
