<?php

namespace App\Http\Controllers;

use App\DataTables\BookingShopDataTable;


class BookingShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookingShopDataTable $dataTable)
    {
        $pageTitle = __('messages.list_form_title', ['form' => __('messages.booking')]);
        $auth_user = authSession();
        $assets = ['datatable'];
        return $dataTable->render('booking.index', compact('pageTitle', 'auth_user', 'assets'));
    }


}
