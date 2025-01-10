<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;


class HomeController extends Controller
{
    public function Home(): Response
    {
        $NewsPressrelease = DB::table('news')
            ->select('users.name as userpost', 'news.*')
            ->join('users', 'users.id', '=', 'news.User_id')
            ->where('news.News_type', '=', 'ข่าวประชาสัมพันธ์')
            ->where('news.status_del', '1')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(10)
            ->get();

        $NewsProcurement = DB::table('news')
            ->select('users.name as userpost', 'news.*')
            ->join('users', 'users.id', '=', 'news.User_id')
            ->where('news.News_type', '=', 'ข่าวจัดซื้อจัดจ้าง')
            ->where('news.status_del', '1')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(10)
            ->get();

        $NewsJob = DB::table('news')
            ->select('users.name as userpost', 'news.*')
            ->join('users', 'users.id', '=', 'news.User_id')
            ->where('news.News_type', '=', 'ข่าวรับสมัครงาน')
            ->where('news.status_del', '1')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(10)
            ->get();

        $NewsDonation = DB::table('news')
            ->select('users.name as userpost', 'news.*')
            ->join('users', 'users.id', '=', 'news.User_id')
            ->where('news.News_type', '=', 'ข่าวบริจาก')
            ->where('news.status_del', '1')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(10)
            ->get();
        // return Redirect::to('/home');
        $potential = DB::table('potential')
            ->where('id_manage', '1')
            ->get();

        // --------------------- ข้อมูลน่าสนใจ
        $interestinginformation_1 = DB::table('interestinginformation')
            // ->join('users', 'users.id', '=', 'news.User_id')
            ->where('interestinginformation_type', '=', 'สารสุขภาพ')
            ->where('status_del', '1')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(8)
            ->get();

        $interestinginformation_2 = DB::table('interestinginformation')
            // ->join('users', 'users.id', '=', 'news.User_id')
            ->where('interestinginformation_type', '=', 'ประกาศ-นโยบาย-มาตรฐานบริการ')
            ->where('status_del', '1')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(8)
            ->get();

        $interestinginformation_3 = DB::table('interestinginformation')
            // ->join('users', 'users.id', '=', 'news.User_id')
            ->where('interestinginformation_type', '=', 'งบทดลองระบบ GFMIS')
            ->where('status_del', '1')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(8)
            ->get();

        $banner = DB::table('banner_images')
            ->where('status_dul', '1')
            ->get();

        return Inertia::render('Fontend/Home/Home', ['NewsPressreleases' => $NewsPressrelease, 'NewsProcurement' => $NewsProcurement, 'NewsJob' => $NewsJob, 'NewsDonation' => $NewsDonation, 'potentialdb' => $potential, 'interestinginformation_1' => $interestinginformation_1, 'interestinginformation_2' => $interestinginformation_2, 'interestinginformation_3' => $interestinginformation_3, 'banners' => $banner]);
    }
}
