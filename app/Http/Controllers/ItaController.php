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

class ItaController extends Controller
{
    // ---------------------------------------------------- fontend

    public function Ita_index(): Response
    {
        $itaSection = DB::table('ita_section')
            ->select('year')
            ->where('id_manage', '1')
            ->groupBy('year')
            ->get();

        foreach ($itaSection as $key => $value) {
            $arr[$key] = $value->year;
        }
        rsort($arr);

        foreach ($arr as $key_y => $value_y) {
            $arr_s[$key_y]['year'] = $arr[$key_y];
            $arr_s[$key_y]['ita_section'] = DB::table('ita_section')
                ->where('id_manage', '1')
                ->where('year', $arr[$key_y])
                ->orderBy('id', 'DESC')
                ->get();

            foreach ($arr_s[$key_y]['ita_section'] as $key_sy => $value_sy) {
                $arr_s[$key_y]['ita_section'][$key_sy]->ita_sub_section = DB::table('ita_sub_section')
                    ->where('id_manage', '1')
                    ->where('id_section', $value_sy->id)
                    ->orderBy('id', 'DESC')
                    ->get();
            }
        }
        // dd($arr_s);
        return Inertia::render('Fontend/Ita/Ita', ['itaSectiondb' => $arr_s]);
    }

    // ---------------------------------------------------- admin
    public function MIta(): Response
    {
        $itaSection = DB::table('ita_section')
            // ->where('news.News_type','=',$type_news)
            ->where('id_manage', '1')
            // ->Where('News_title','like','%'.''.'%')
            ->orderBy('id', 'DESC')
            // ->skip(0)
            // ->take(10)
            // ->get();
            ->paginate(10);

        foreach ($itaSection as $key => $value) {
            $ita_sub_section_cont = DB::table('ita_sub_section')
                ->where('id_section', $value->id)
                ->where('id_manage', '1')
                ->count();

            $itaSection[$key]->ita_sub_section_cont = $ita_sub_section_cont;
        }
        // dd($itaSection);

        $title[0] = '';

        return Inertia::render('Admin/ManageATI/MIta', ['itaSectiondb' => $itaSection]);
    }

    public function MIta_create(): Response
    {

        $ita_section = DB::table('ita_section')
            ->where('id_manage', '1')
            ->orderBy('id', 'DESC')
            ->get();

        // dd($ita_section);

        return Inertia::render('Admin/ManageATI/MIta_add', ['ita_sections' => $ita_section]);
    }

    public function MIta_create_insert(Request $request): RedirectResponse
    {
        // dd($request);
        DB::table('ita_section')->insert(
            [
                'name' => $request->name,
                'detail' => '',
                'year' => $request->year,
                'id_user' => Auth::user()->id,
                'id_manage' => $request->id_manage,
            ]
        );
        return Redirect::route('Manage.MIta_create');
    }

    public function MIta_sub_create_insert(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';
        $urlimage = 'http://127.0.0.1:8000/storage/images/ItaFiles/';
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $exten = $file->getClientOriginalExtension();
            $filename = "Ita" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/ItaFiles', $filename);

            $refilename = $urlimage . $filename;
        } else {
            $refilename = null;
        }
        DB::table('ita_sub_section')->insert(
            [
                'name' => $request->name,
                'detail' => $request->detail,
                'year' => $request->year,
                'id_section' => $request->id_section,
                'id_user' => Auth::user()->id,
                'id_manage' => $request->id_manage,
                'files' => $refilename,
            ]
        );
        return Redirect::route('Manage.MIta');
    }

    public function MIta_edit(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';

        DB::table('ita_section')->where('id', $request->id)->update(
            [
                'name' => $request->name,
                'year' => $request->year,
            ]
        );
        return Redirect::route('Manage.MIta');
    }

    public function MIta_delete(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';

        DB::table('ita_section')->where('id', $request->id)->update(
            [
                'id_manage' => '2',
            ]
        );
        return Redirect::route('Manage.MIta');
    }

    // ------------------ detali ข้อมูลย้อย

    public function MIta_detail($id): Response
    {
        $ita = DB::table('ita_section')
            ->where('id', $id)
            ->get();

        $itaSection = DB::table('ita_sub_section')
            ->where('id_section', $id)
            ->where('id_manage', '1')
            ->Where('name', 'like', '%' . '' . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $title[0] = '';

        return Inertia::render('Admin/ManageATI/MIta_detail', ['itaSectiondb' => $itaSection, 'itadb' => $ita]);
    }

    public function MIta_sub_edit(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';
        $urlimage = 'http://127.0.0.1:8000/storage/images/ItaFiles/';
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $exten = $file->getClientOriginalExtension();
            $filename = "Ita" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/ItaFiles', $filename);

            $refilename = $urlimage . $filename;

            DB::table('ita_sub_section')->where('id', $request->id)->update(
                [
                    'name' => $request->name,
                    'year' => $request->year,
                    'files' => $refilename,
                ]
            );
        } else {
            DB::table('ita_sub_section')->where('id', $request->id)->update(
                [
                    'name' => $request->name,
                    'year' => $request->year,
                ]
            );
        }

        return Redirect::route('Manage.MIta_detail', $request->id);
    }

    public function MIta_sub_delete(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';

        DB::table('ita_sub_section')->where('id', $request->id)->update(
            [
                'id_manage' => '2',
            ]
        );
        return Redirect::route('Manage.MIta_detail', $request->id);
    }
}
