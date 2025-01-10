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

class MHealthSubstancesController extends Controller
{
    public function InterestingInformation($type_news): Response
    {


        $data = DB::table('interestinginformation')
            // ->select('users.name as userpost', 'interestinginformation.*')
            // ->join('users', 'users.id', '=', 'interestinginformation.User_id')
            ->where('interestinginformation.interestingInformation_type', '=', $type_news)
            ->where('interestinginformation.status_del', '1')
            ->orderBy('id', 'DESC')
            ->get();

        $title[0] = $type_news;
        return Inertia::render('Fontend/InterestingInformation/Interestinginformation', ['datadb' => $data, 'title' => $title]);
    }

    // public function News_purchase($type_news): Response
    // {
    //     $News = DB::table('news')
    //         ->select('users.name as userpost', 'news.*')
    //         ->join('users', 'users.id', '=', 'news.User_id')
    //         ->where('news.News_type', '=', $type_news)
    //         ->where('news.status_del', '1')
    //         ->orderBy('id', 'DESC')
    //         ->get();

    //     $title[0] = $type_news;
    //     return Inertia::render('Fontend/News/News_purchase', ['Newsdb' => $News, 'titlenews' => $title]);
    // }

    public function InterestingInformation_detail($id): Response
    {
        $data = DB::table('interestinginformation')
            ->select('users.name as userpost', 'interestinginformation.*')
            ->join('users', 'users.id', '=', 'interestinginformation.User_id')
            ->where('interestinginformation.status_del', '1')
            ->where('interestinginformation.id', '=', $id)
            ->get();

        $images = unserialize($data[0]->interestingInformation_images);
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data[0]->url_page = $actual_link;
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
        return Inertia::render('Fontend/InterestingInformation/Interestinginformation_detail', ['datadb' => $data, 'Images' => $images, 'Newsrelevants' => $Newsrelevant]);
    }

    // -------------- admin
    public function MHealthSubstances(Request $request): Response
    {
        $interestinginformation_type['0'] = DB::table('interestinginformation')
            ->where('interestinginformation_type', 'ข่าวประชาสัมพันธ์')
            ->where('status_del', '1')
            ->count('id');

        $interestinginformation_type['1'] = DB::table('interestinginformation')
            ->where('interestinginformation_type', 'ข่าวจัดซื้อจัดจ้าง')
            ->where('status_del', '1')
            ->count('id');

        $interestinginformation_type['2'] = DB::table('interestinginformation')
            ->where('interestinginformation_type', 'ข่าวรับสมัครงาน')
            ->where('status_del', '1')
            ->count('id');

        // dd($News_type);

        $interestinginformation = DB::table('interestinginformation')
            // ->where('news.News_type','=',$type_news)
            ->where('status_del', '1')
            ->Where('interestinginformation_title', 'like', '%' . $request->search . '%')
            ->orderBy('id', 'DESC')
            // ->skip(0)
            // ->take(10)
            // ->get();
            ->paginate(10);

        // dd($News['links']);

        $title[0] = '';
        return Inertia::render('Admin/MInterestingInformation/MHealthSubstances/MHealthSubstances', ['Interestinginformationdb' => $interestinginformation, 'titleInterestinginformation_type' => $title, 'InterestinginformationType' => $interestinginformation_type]);
    }



    public function MHealthSubstances_create(): Response
    {
        return Inertia::render('Admin/MInterestingInformation/MHealthSubstances/MHealthSubstances_create');
    }

    public function MHealthSubstances_create_insert(Request $request): RedirectResponse
    {
        // dd($request);
        $urlimage = 'http://127.0.0.1:8000/storage/images/HealthSubstancesImages/';
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/HealthSubstancesImages/';
        if ($request->hasFile('interestinginformation_title_image')) {
            $file = $request->file('interestinginformation_title_image');
            $exten = $file->getClientOriginalExtension();
            $filename = "interestinginformation_title_" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/HealthSubstancesImages', $filename);

            $refilename = $urlimage . $filename;
        } else {
            $refilename = null;
        }

        if ($request->hasFile('interestinginformation_images')) {
            foreach ($request->file('interestinginformation_images') as $key => $value) {
                $files = $request->file('interestinginformation_images')[$key];
                $extens = $files->getClientOriginalExtension();
                $filenames = "interestinginformation_" . $key . "_K_" . rand() . "_R_" . time() . "." . $extens;
                $files->move('storage/images/HealthSubstancesImages', $filenames);
                $refilenames[$key] = $urlimage . $filenames;
            }

            $interestinginformation_image = serialize($refilenames);
        } else {
            $interestinginformation_image = null;
        }

        DB::table('interestinginformation')->insert(
            [
                'interestinginformation_title' => $request->interestinginformation_title,
                'interestinginformation_type' => $request->interestinginformation_type,
                'interestinginformation_title_image' => $refilename,
                'interestinginformation_detail' => $request->interestinginformation_detail,
                'interestinginformation_images' => $interestinginformation_image,
                'interestinginformation_views' => '0',
                'User_id' => Auth::user()->id,
                'status_del' => '1',
            ]
        );

        return Redirect::route('Manage.MHealthSubstances');
    }

    public function MHealthSubstances_move_bin($id): RedirectResponse
    {
        DB::table('interestinginformation')
            ->where('id', $id)
            ->update(['status_del' => '0']);

        return Redirect::route('Manage.MHealthSubstances');
    }

    public function MHealthSubstances_edit($id): Response
    {
        // dd($id);
        $interestinginformation = DB::table('interestinginformation')
            ->where('id', $id)
            ->get();

        $interestinginformation[0]->interestingInformation_images = unserialize($interestinginformation[0]->interestingInformation_images);
        // dd($News[0]);
        // dd($interestinginformation);
        return Inertia::render('Admin/MInterestingInformation/MHealthSubstances/MHealthSubstances_edit', ['Newsdb' => $interestinginformation]);
    }

    public function MHealthSubstances_edit_update(Request $request): RedirectResponse
    {
        // dd($request);
        $urlimage = 'http://127.0.0.1:8000/storage/images/HealthSubstancesImages/';
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/HealthSubstancesImages/';
        if ($request->hasFile('interestinginformation_title_image')) {
            $file = $request->file('interestinginformation_title_image');
            $exten = $file->getClientOriginalExtension();
            $filename = "interestinginformation_title_" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/HealthSubstancesImages', $filename);

            $refilename = $urlimage . $filename;
        } else {
            $refilename = null;
        }

        if ($request->hasFile('interestinginformation_images')) {
            foreach ($request->file('interestinginformation_images') as $key => $value) {
                $files = $request->file('interestinginformation_images')[$key];
                $extens = $files->getClientOriginalExtension();
                $filenames = "interestinginformation_" . $key . "_K_" . rand() . "_R_" . time() . "." . $extens;
                $files->move('storage/images/HealthSubstancesImages', $filenames);
                $refilenames[$key] = $urlimage . $filenames;
            }

            $interestinginformation_image = serialize($refilenames);
        } else {
            $interestinginformation_image = null;
        }

        if ($refilename != null && $interestinginformation_image != null) {
            DB::table('interestinginformation')->where('id', $request->id)->update(
                [
                    'interestinginformation_title' => $request->interestinginformation_title,
                    // 'interestinginformation_type' => $request->interestinginformation_type,
                    'interestinginformation_title_image' => $refilename,
                    'interestinginformation_detail' => $request->interestinginformation_detail,
                    'interestinginformation_images' => $interestinginformation_image,
                    'User_id' => Auth::user()->id,
                ]
            );
        } elseif ($refilename != null && $interestinginformation_image == null) {
            DB::table('interestinginformation')->where('id', $request->id)->update(
                [
                    'interestinginformation_title' => $request->interestinginformation_title,
                    // 'interestinginformation_type' => $request->interestinginformation_type,
                    'interestinginformation_title_image' => $refilename,
                    'interestinginformation_detail' => $request->interestinginformation_detail,
                    'User_id' => Auth::user()->id,
                ]
            );
        } elseif ($refilename == null && $interestinginformation_image != null) {
            DB::table('interestinginformation')->where('id', $request->id)->update(
                [
                    'interestinginformation_title' => $request->interestinginformation_title,
                    // 'interestinginformation_type' => $request->interestinginformation_type,
                    'interestinginformation_detail' => $request->interestinginformation_detail,
                    'interestinginformation_images' => $interestinginformation_image,
                    'User_id' => Auth::user()->id,
                ]
            );
        } elseif ($refilename == null && $interestinginformation_image == null) {
            DB::table('interestinginformation')->where('id', $request->id)->update(
                [
                    'interestinginformation_title' => $request->interestinginformation_title,
                    // 'interestinginformation_type' => $request->interestinginformation_type,
                    'interestinginformation_detail' => $request->interestinginformation_detail,
                    'User_id' => Auth::user()->id,
                ]
            );
        }


        return Redirect::route('Manage.MHealthSubstances');
    }
}
