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

class NewsController extends Controller
{
    public function Press_Release($type_news): Response
    {
        $News = DB::table('news')
            ->select('users.name as userpost', 'news.*')
            ->join('users', 'users.id', '=', 'news.User_id')
            ->where('news.News_type', '=', $type_news)
            ->where('news.status_del', '1')
            ->orderBy('id', 'DESC')
            ->get();

        $title[0] = $type_news;
        return Inertia::render('Fontend/News/News_press_release', ['Newsdb' => $News, 'titlenews' => $title]);
    }

    public function News_purchase($type_news): Response
    {
        $News = DB::table('news')
            ->select('users.name as userpost', 'news.*')
            ->join('users', 'users.id', '=', 'news.User_id')
            ->where('news.News_type', '=', $type_news)
            ->where('news.status_del', '1')
            ->orderBy('id', 'DESC')
            ->get();

        $title[0] = $type_news;
        return Inertia::render('Fontend/News/News_purchase', ['Newsdb' => $News, 'titlenews' => $title]);
    }

    public function Press_Release_detail($id): Response
    {
        $News = DB::table('news')
            ->select('users.name as userpost', 'news.*')
            ->join('users', 'users.id', '=', 'news.User_id')
            ->where('news.status_del', '1')
            ->where('news.id', '=', $id)
            ->get();

        $images = unserialize($News[0]->News_images);
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $News[0]->url_page = $actual_link;
        // dd($News,$actual_link,$images);

        $Newsrelevant = DB::table('news')
            ->select('users.name as userpost', 'news.*')
            ->join('users', 'users.id', '=', 'news.User_id')
            ->where('news.News_type', '=', 'ข่าวประชาสัมพันธ์')
            ->where('news.status_del', '1')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit(5)
            ->get();
        return Inertia::render('Fontend/News/News_press_release_detail', ['Newsdb' => $News, 'Images' => $images, 'Newsrelevants' => $Newsrelevant]);
    }

    // -------------- admin
    public function MNews(Request $request): Response
    {
        $News_type['0'] = DB::table('news')
            ->where('News_type', 'ข่าวประชาสัมพันธ์')
            ->where('status_del', '1')
            ->count('id');

        $News_type['1'] = DB::table('news')
            ->where('News_type', 'ข่าวจัดซื้อจัดจ้าง')
            ->where('status_del', '1')
            ->count('id');

        $News_type['2'] = DB::table('news')
            ->where('News_type', 'ข่าวรับสมัครงาน')
            ->where('status_del', '1')
            ->count('id');

        $News_type['3'] = DB::table('news')
            ->where('News_type', 'ข่าวรับสมัครงาน')
            ->where('status_del', '1')
            ->count('id');

        // dd($News_type);

        $News = DB::table('news')
            // ->where('news.News_type','=',$type_news)
            ->where('status_del', '1')
            ->Where('News_title', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            // ->skip(0)
            // ->take(10)
            // ->get();
            ->paginate(10);

        // dd($News['links']);

        $title[0] = '';
        return Inertia::render('Admin/ManageNews/MNews', ['Newsdb' => $News, 'titlenews' => $title, 'NewsType' => $News_type]);
    }



    public function MNews_create(): Response
    {
        return Inertia::render('Admin/ManageNews/MNews_create');
    }

    public function MNews_create_insert(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://127.0.0.1:8000/storage/images/NewsImages/';
        // $urlimage = 'http://localhost/storage/images/NewsImages/';
        $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';
        if ($request->hasFile('News_title_image')) {
            $file = $request->file('News_title_image');
            $exten = $file->getClientOriginalExtension();
            $filename = "News" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/NewsImages', $filename);

            $refilename = $urlimage . $filename;
        } else {
            $refilename = null;
        }

        if ($request->hasFile('News_images')) {
            foreach ($request->file('News_images') as $key => $value) {
                $files = $request->file('News_images')[$key];
                $extens = $files->getClientOriginalExtension();
                $filenames = "News_" . $key . "_K_" . rand() . "_R_" . time() . "." . $extens;
                $files->move('storage/images/NewsImages', $filenames);
                $refilenames[$key] = $urlimage . $filenames;
            }

            $News_image = serialize($refilenames);
        } else {
            $News_image = null;
        }

        DB::table('news')->insert(
            [
                'News_title' => $request->News_title,
                'News_type' => $request->News_type,
                'News_title_image' => $refilename,
                'News_detail' => $request->News_detail,
                'News_images' => $News_image,
                'News_views' => '0',
                'User_id' => Auth::user()->id,
                'status_del' => '1',
            ]
        );

        return Redirect::route('Manage.MNews');
    }

    public function MNews_move_bin($id): RedirectResponse
    {
        DB::table('news')
            ->where('id', $id)
            ->update(['status_del' => '0']);

        return Redirect::route('Manage.MNews');
    }

    public function MNews_edit($id): Response
    {
        $News = DB::table('news')
            ->where('id', $id)
            ->get();

        $News[0]->News_images = unserialize($News[0]->News_images);
        // dd($News[0]);

        return Inertia::render('Admin/ManageNews/MNews_edit', ['Newsdb' => $News]);
    }

    public function MNews_edit_update(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://127.0.0.1:8000/storage/images/NewsImages/';
        $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';
        if ($request->hasFile('News_title_image')) {
            $file = $request->file('News_title_image');
            $exten = $file->getClientOriginalExtension();
            $filename = "News" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/NewsImages', $filename);

            $refilename = $urlimage . $filename;
        } else {
            $refilename = null;
        }

        if ($request->hasFile('News_images')) {
            foreach ($request->file('News_images') as $key => $value) {
                $files = $request->file('News_images')[$key];
                $extens = $files->getClientOriginalExtension();
                $filenames = "News_" . $key . "_K_" . rand() . "_R_" . time() . "." . $extens;
                $files->move('storage/images/NewsImages', $filenames);
                $refilenames[$key] = $urlimage . $filenames;
            }

            $News_image = serialize($refilenames);
        } else {
            $News_image = null;
        }

        if ($refilename != null && $News_image != null) {
            DB::table('news')->where('id', $request->id)->update(
                [
                    'News_title' => $request->News_title,
                    // 'News_type' => $request->News_type,
                    'News_title_image' => $refilename,
                    'News_detail' => $request->News_detail,
                    'News_images' => $News_image,
                    'User_id' => Auth::user()->id,
                ]
            );
        } elseif ($refilename != null && $News_image == null) {
            DB::table('news')->where('id', $request->id)->update(
                [
                    'News_title' => $request->News_title,
                    // 'News_type' => $request->News_type,
                    'News_title_image' => $refilename,
                    'News_detail' => $request->News_detail,
                    'User_id' => Auth::user()->id,
                ]
            );
        } elseif ($refilename == null && $News_image != null) {
            DB::table('news')->where('id', $request->id)->update(
                [
                    'News_title' => $request->News_title,
                    // 'News_type' => $request->News_type,
                    'News_detail' => $request->News_detail,
                    'News_images' => $News_image,
                    'User_id' => Auth::user()->id,
                ]
            );
        } elseif ($refilename == null && $News_image == null) {
            DB::table('news')->where('id', $request->id)->update(
                [
                    'News_title' => $request->News_title,
                    // 'News_type' => $request->News_type,
                    'News_detail' => $request->News_detail,
                    'User_id' => Auth::user()->id,
                ]
            );
        }


        return Redirect::route('Manage.MNews');
    }
}
