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

use function PHPSTORM_META\type;

class PatientServiceController extends Controller
{
    // ---------------------------------------------------- fontend

    public function DoctorTable_index(): Response
    {

        $arr_s['doctor_table_section'] = DB::table('doctor_table_section')
            ->where('id_manage', '1')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($arr_s['doctor_table_section'] as $key_sy => $value_sy) {
            $arr_s['doctor_table_section'][$key_sy]->doctor_table_details = DB::table('doctor_table_details')
                ->where('id_manage', '1')
                ->where('doctor_table_section_id', $value_sy->id)
                ->orderBy('id', 'DESC')
                ->get();
        }

        // dd($arr_s);
        return Inertia::render('Fontend/PatientService/PatientService', ['doctor_tables' => $arr_s]);
    }

    public function PatientRoom_index(): Response
    {

        $page_patient_room = DB::table('page_patient_room')
            ->get()[0];

            if (isset($page_patient_room)) {


                if ($page_patient_room->room_booking_detail != "") {
                    $page_patient_room->room_booking_detail = unserialize($page_patient_room->room_booking_detail);
                }
                if ($page_patient_room->room_facilities_detail != "") {
                    $page_patient_room->room_facilities_detail = unserialize($page_patient_room->room_facilities_detail);
                }
                if ($page_patient_room->room_food_service_detail != "") {
                    $page_patient_room->room_food_service_detail = unserialize($page_patient_room->room_food_service_detail);
                }
                if ($page_patient_room->room_additional_announcements_detail != "") {
                    $page_patient_room->room_additional_announcements_detail = unserialize($page_patient_room->room_additional_announcements_detail);
                }
            }

            $page_patient_room_price = DB::table('page_patient_room_price')
            ->get();

            if (isset($page_patient_room_price)) {
              foreach ($page_patient_room_price as $key => $value) {
                if ($page_patient_room_price[$key]->room_address_th != "") {
                    $page_patient_room_price[$key]->room_address_th = unserialize($page_patient_room_price[$key]->room_address_th);
                    unset($page_patient_room_price[$key]->room_address_th[0]);
                }
                if ($page_patient_room_price[$key]->room_address_en != "") {
                    $page_patient_room_price[$key]->room_address_en = unserialize($page_patient_room_price[$key]->room_address_en);
                    unset($page_patient_room_price[$key]->room_address_en[0]);
                }
              }
            }
            // dd($page_patient_room,$page_patient_room_price);

        return Inertia::render('Fontend/PatientService/PatientRoom', ['page_patient_rooms' => $page_patient_room, 'page_patient_room_prices' => $page_patient_room_price ]);
    }

    // ---------------------- admin
    public function MDoctorTable(): Response
    {
        $doctor_tables = DB::table('doctor_table_section')
            // ->where('news.News_type','=',$type_news)
            ->where('id_manage', '1')
            // ->Where('News_title','like','%'.''.'%')
            ->orderBy('id', 'DESC')
            // ->skip(0)
            // ->take(10)
            // ->get();
            ->paginate(10);

        foreach ($doctor_tables as $key => $value) {
            $ita_sub_section_cont = DB::table('doctor_table_details')
                ->where('doctor_table_section_id', $value->id)
                ->where('id_manage', '1')
                ->count();

            $doctor_tables[$key]->ita_sub_section_cont = $ita_sub_section_cont;
        }
        // dd($itaSection);

        $title[0] = '';

        return Inertia::render('Admin/ManagePatientService/MDoctorTable/MDoctorTable', ['doctor_tables' => $doctor_tables]);
    }

    public function MDoctorTable_create(): Response
    {

        $doctor_table_section = DB::table('doctor_table_section')
            ->where('id_manage', '1')
            ->orderBy('id', 'DESC')
            ->get();

        // dd($ita_section);

        return Inertia::render('Admin/ManagePatientService/MDoctorTable/MDoctorTable_add', ['doctor_table_sections' => $doctor_table_section]);
    }

    public function MDoctorTable_create_insert(Request $request): RedirectResponse
    {
        // dd($request);
        DB::table('doctor_table_section')->insert(
            [
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'id_user' => Auth::user()->id,
                'id_manage' => $request->id_manage,
            ]
        );
        return Redirect::route('Manage.MDoctorTable_create');
    }

    public function MDoctorTable_sub_create_insert(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';
        $urlimage = 'http://127.0.0.1:8000/storage/images/DoctorTable/';
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $exten = $file->getClientOriginalExtension();
            $filename = "DoctorTable" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/DoctorTable', $filename);

            $refilename = $urlimage . $filename;
        } else {
            $refilename = null;
        }
        DB::table('doctor_table_details')->insert(
            [
                'doctor_table_section_id' => $request->doctor_table_section_id,
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
                'id_user' => Auth::user()->id,
                'id_manage' => $request->id_manage,
                'files' => $refilename,
            ]
        );
        return Redirect::route('Manage.MDoctorTable');
    }

    public function MDoctorTable_edit(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';

        DB::table('doctor_table_section')->where('id', $request->id)->update(
            [
                'name_th' => $request->name_th,
                'name_en' => $request->name_en,
            ]
        );
        return Redirect::route('Manage.MDoctorTable');
    }

    public function MDoctorTable_delete(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';

        DB::table('doctor_table_section')->where('id', $request->id)->update(
            [
                'id_manage' => '2',
            ]
        );
        return Redirect::route('Manage.MDoctorTable');
    }

    // ------------------ detali ข้อมูลย้อย

    public function MDoctorTable_detail($id): Response
    {
        $doctor_table_sections = DB::table('doctor_table_section')
            ->where('id', $id)
            ->get();

        $doctor_table_details = DB::table('doctor_table_details')
            ->where('doctor_table_section_id', $id)
            ->where('id_manage', '1')
            ->Where('name_th', 'like', '%' . '' . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $title[0] = '';

        return Inertia::render('Admin/ManagePatientService/MDoctorTable/MDoctorTable_detail', ['doctor_table_details' => $doctor_table_details, 'doctor_table_sections' => $doctor_table_sections]);
    }

    public function MDoctorTable_sub_edit(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';
        $urlimage = 'http://127.0.0.1:8000/storage/images/DoctorTable/';
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $exten = $file->getClientOriginalExtension();
            $filename = "DoctorTable" . rand() . "_R_" . time() . "." . $exten;

            $file->move('storage/images/DoctorTable', $filename);

            $refilename = $urlimage . $filename;

            DB::table('doctor_table_details')->where('id', $request->id)->update(
                [
                    'name_th' => $request->name_th,
                    'name_en' => $request->name_en,
                    'files' => $refilename,
                ]
            );
        } else {
            DB::table('doctor_table_details')->where('id', $request->id)->update(
                [
                    'name_th' => $request->name_th,
                    'name_en' => $request->name_en,
                ]
            );
        }

        return Redirect::route('Manage.MDoctorTable_detail', $request->id_title);
    }

    public function MDoctorTable_sub_delete(Request $request): RedirectResponse
    {
        // dd($request);
        // $urlimage = 'http://satunhospital.com/test_web_hospital/storage/images/NewsImages/';

        DB::table('doctor_table_details')->where('id', $request->id)->update(
            [
                'id_manage' => '2',
            ]
        );
        return Redirect::route('Manage.MDoctorTable_detail', $request->id_title);
    }

    // ----------------- MPatientRoom -------------
    public function MPatientRoom(): Response
    {
        $page_patient_room = DB::table('page_patient_room')
            ->get()[0];

            if (isset($page_patient_room)) {
                if ($page_patient_room->room_booking_detail != "") {
                    $room_booking_detail = unserialize($page_patient_room->room_booking_detail);
                }else {
                    $room_booking_detail = "";
                }

                if ($page_patient_room->room_facilities_detail != "") {
                    $room_facilities_detail = unserialize($page_patient_room->room_facilities_detail);
                }else{
                    $room_facilities_detail = "";
                }

                if ($page_patient_room->room_food_service_detail != "") {
                    $room_food_service_detail = unserialize($page_patient_room->room_food_service_detail);
                }else{
                    $room_food_service_detail = "";
                }

                if ($page_patient_room->room_additional_announcements_detail != "") {
                    $room_additional_announcements_detail = unserialize($page_patient_room->room_additional_announcements_detail);
                }else{
                    $room_additional_announcements_detail = "";
                }
            }

            $page_patient_room_price = DB::table('page_patient_room_price')
            ->get();

            foreach ($page_patient_room_price as $key => $value) {

                if ($value->room_address_th != "") {
                    $page_patient_room_price[$key]->room_address_th = unserialize($value->room_address_th);
                    unset($page_patient_room_price[$key]->room_address_th[0]);
                }else{
                    $page_patient_room_price[$key]->room_address_th = "";
                }

                if ($value->room_address_en != "") {
                    $page_patient_room_price[$key]->room_address_en = unserialize($value->room_address_en);
                    unset($page_patient_room_price[$key]->room_address_en[0]);
                }else{
                    $page_patient_room_price[$key]->room_address_en = "";
                }

            }

            // dd($page_patient_room_price);

        return Inertia::render('Admin/ManagePatientService/MPatientRoom/MPatientRoom', ['room_booking_details' => $room_booking_detail, 'room_facilities_details' => $room_facilities_detail, 'room_food_service_details' => $room_food_service_detail, 'room_additional_annnouncements_details' => $room_additional_announcements_detail,'page_patient_room_prices' => $page_patient_room_price]);
    }

    public function MPatientRoom_insert(Request $request): RedirectResponse
    {

        $db_db_coulunm = $request['db_coulunm'];
        // dd($request,$db_db_coulunm);
        $page_patient_room = DB::table('page_patient_room')
            ->get();
        if (isset($page_patient_room[0])) {

            if (isset($request->room_booking_detail_th_add)) {

                if ($page_patient_room[0]->$db_db_coulunm == "") {
                    // dd('yyyy');
                    $room_booking_detail[0] = [
                        'th' => $request->room_booking_detail_th_add,
                        'en' => $request->room_booking_detail_en_add,
                        'id_manage' => $request->id_manage
                    ];
                    $room_booking_detail_srl = serialize($room_booking_detail);
                    // dd($room_booking_detail_srl);
                    $typeSave = 'room_booking_detail_update';

                }else{
                    // dd('nnnn');
                    $room_booking_detail = unserialize($page_patient_room[0]->$db_db_coulunm);
                    $rbd_add_arr_end = count($room_booking_detail);
                    // dd($rbd_add,$rbd_add_arr_end );
                    $room_booking_detail[$rbd_add_arr_end] = [
                        'th' => $request->room_booking_detail_th_add,
                        'en' => $request->room_booking_detail_en_add,
                        'id_manage' => $request->id_manage
                    ];

                    $room_booking_detail_srl = serialize($room_booking_detail);

                    $typeSave = 'room_booking_detail_update';
                }
            }

        } else {
            if (isset($request->room_booking_detail_th_add)) {
                $room_booking_detail[0] = [
                    'th' => $request->room_booking_detail_th_add,
                    'en' => $request->room_booking_detail_en_add,
                    'id_manage' => $request->id_manage
                ];
                $room_booking_detail_srl = serialize($room_booking_detail);

                $typeSave = 'room_booking_detail_insert';
            }
        }

        if ($typeSave == 'room_booking_detail_insert') {

            DB::table('page_patient_room')->insert(
                [
                    $db_db_coulunm => $room_booking_detail_srl,
                ]
            );
        }

        if ($typeSave == 'room_booking_detail_update') {
            DB::table('page_patient_room')->update(
                [
                    $db_db_coulunm => $room_booking_detail_srl,
                ]
            );
        }

        $test = DB::table('page_patient_room')
            ->get();
            $test1 = unserialize($test[0]->room_booking_detail);
            // dd($test1);

        return Redirect::route('Manage.MPatientRoom');
    }

    public function MPatientRoom_edit(Request $request): RedirectResponse
    {

        $db_db_coulunm = $request['db_coulunm'];
        $page_patient_room = DB::table('page_patient_room')
            ->get();
        $room_booking_detail = unserialize($page_patient_room[0]->$db_db_coulunm);

        $room_booking_detail[$request->arr]['th'] = $request->room_booking_detail_th_edit;
        $room_booking_detail[$request->arr]['en'] = $request->room_booking_detail_en_edit;
        $room_booking_detail[$request->arr]['id_manage'] = $request->id_manage;
        // dd($request, $room_booking_detail);
        $room_booking_detail_srl = serialize($room_booking_detail);
        DB::table('page_patient_room')->update(
            [
                $db_db_coulunm => $room_booking_detail_srl,
            ]
        );

        return Redirect::route('Manage.MPatientRoom');
    }

    public function MPatientRoom_delete(Request $request): RedirectResponse
    {

        $db_db_coulunm = $request['db_coulunm'];
        // dd($db_db_coulunm, $request);
        $page_patient_room = DB::table('page_patient_room')
            ->get();
        $room_booking_detail = unserialize($page_patient_room[0]->$db_db_coulunm);

        $rbd_add_arr_end = count($room_booking_detail);
        if ($rbd_add_arr_end == 1) {
            $room_booking_detail_srl = "";
        }else{
            array_splice($room_booking_detail, $request->arr, 1);
            // dd($request, $room_booking_detail);
            $room_booking_detail_srl = serialize($room_booking_detail);
        }

        DB::table('page_patient_room')->update(
            [
                $db_db_coulunm => $room_booking_detail_srl,
            ]
        );

        return Redirect::route('Manage.MPatientRoom');
    }
    // --------------- adress
    public function MPatientRoom_title_edit(Request $request): RedirectResponse
    {
        // dd($request);
        DB::table('page_patient_room_price')->where('id',$request->e_id)->update(
            [
                'room_type_th' => $request->e_room_type_th,
                'room_type_en' => $request->e_room_type_en,
            ]
        );

        return Redirect::route('Manage.MPatientRoom');
    }

    public function MPatientRoom_price_edit(Request $request): RedirectResponse
    {
        DB::table('page_patient_room_price')->where('id',$request->e_id)->update(
            [
                'room_price' => $request->e_room_price,
            ]
        );

        return Redirect::route('Manage.MPatientRoom');
    }

    public function MPatientRoom_price_insert(Request $request): RedirectResponse
    {
        // dd($request);
        $room_address_th = serialize($request->room_address_th);
        $room_address_en = serialize($request->room_address_en);
        // dd($request,$room_address_th,$room_address_en);
        DB::table('page_patient_room_price')->insert(
            [
                'room_type_th' => $request->room_type_th,
                'room_type_en' => $request->room_type_en,
                'room_price' => $request->room_price,
                'room_address_th' => $room_address_th,
                'room_address_en' => $room_address_en,
            ]
        );

        return Redirect::route('Manage.MPatientRoom');
    }

    public function MPatientRoom_address_edit(Request $request): RedirectResponse
    {

        $getData = DB::table('page_patient_room_price')->where('id',$request->e_id)->get();

        $room_address_th = unserialize($getData[0]->room_address_th);
        $room_address_en = unserialize($getData[0]->room_address_en);

        $room_address_th[$request->e_room_key] = $request->e_room_address_th;
        $room_address_en[$request->e_room_key] = $request->e_room_address_en;

        $room_address_th = serialize($room_address_th);
        $room_address_en = serialize($room_address_en);

        DB::table('page_patient_room_price')->where('id',$request->e_id)->update(
            [
                'room_address_th' => $room_address_th,
                'room_address_en' => $room_address_en,
            ]
        );

        return Redirect::route('Manage.MPatientRoom');
    }

    public function MPatientRoom_address_delete(Request $request): RedirectResponse
    {

        $getData = DB::table('page_patient_room_price')->where('id',$request->e_id)->get();

        $room_address_th = unserialize($getData[0]->room_address_th);
        $room_address_en = unserialize($getData[0]->room_address_en);

        array_splice($room_address_th, $request->e_room_key, 1);
        array_splice($room_address_en, $request->e_room_key, 1);

        $room_address_th = serialize($room_address_th);
        $room_address_en = serialize($room_address_en);

        DB::table('page_patient_room_price')->where('id',$request->e_id)->update(
            [
                'room_address_th' => $room_address_th,
                'room_address_en' => $room_address_en,
            ]
        );

        return Redirect::route('Manage.MPatientRoom');
    }

    public function MPatientRoom_address_add(Request $request): RedirectResponse
    {
        $getData = DB::table('page_patient_room_price')->where('id',$request->a_id)->get();

        $room_address_th = unserialize($getData[0]->room_address_th);
        $room_address_en = unserialize($getData[0]->room_address_en);

        $c_arr = count($room_address_th);

        $room_address_th[$c_arr] = $request->a_room_address_th;
        $room_address_en[$c_arr] = $request->a_room_address_en;
        // dd($c_arr,$request,$getData,$room_address_th,$room_address_en);

        $room_address_th = serialize($room_address_th);
        $room_address_en = serialize($room_address_en);

        DB::table('page_patient_room_price')->where('id',$request->a_id)->update(
            [
                'room_address_th' => $room_address_th,
                'room_address_en' => $room_address_en,
            ]
        );

        return Redirect::route('Manage.MPatientRoom');
    }

    public function MPatientRoom_all_delete(Request $request): RedirectResponse
    {
        // dd($request);
        DB::table('page_patient_room_price')->where('id',$request->e_id)->delete();

        return Redirect::route('Manage.MPatientRoom');
    }
    // --------------------------------------
    public function TreatmentForm_index(): Response
    {
        $treatment_form = DB::table('treatment_form')->get();
        return Inertia::render('Fontend/PatientService/TreatmentForm', ['treatment_forms' => $treatment_form]);
    }

    public function MTreatmentForm(): Response
    {
        $treatment_form = DB::table('treatment_form')->get();
        return Inertia::render('Admin/ManagePatientService/ManageTreatmentForm/MTreatmentForm', ['treatment_forms' => $treatment_form]);
    }

    public function MTreatmentFormUpdate(Request $request): RedirectResponse
    {
        // dd($request);
        DB::table('treatment_form')->where('id',1)->update(
            [
                'detail' => $request->content,
            ]
        );

        return Redirect::route('Manage.MTreatmentForm');
    }

}
