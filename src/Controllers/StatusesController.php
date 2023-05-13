<?php

namespace Binshops\LaravelTicket\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Binshops\LaravelTicket\Models\Status;
use Binshops\LaravelTicket\Helpers\LaravelVersion;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // seconds expected for L5.8<=, minutes before that
        $time = LaravelVersion::min('5.8') ? 60*60 : 60;
        $statuses = \Cache::remember('laravelticket::statuses', $time, function () {
            return Status::all();
        });

        return view('laravelticket::admin.status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('laravelticket::admin.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'color'     => 'required',
        ]);

        $status = new Status();
        $status->create(['name' => $request->name, 'color' => $request->color]);

        Session::flash('status', trans('laravelticket::lang.status-name-has-been-created', ['name' => $request->name]));

        \Cache::forget('laravelticket::statuses');

        return redirect()->action('\Binshops\LaravelTicket\Controllers\StatusesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return trans('laravelticket::lang.status-all-tickets-here');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $status = Status::findOrFail($id);

        return view('laravelticket::admin.status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'color'     => 'required',
        ]);

        $status = Status::findOrFail($id);
        $status->update(['name' => $request->name, 'color' => $request->color]);

        Session::flash('status', trans('laravelticket::lang.status-name-has-been-modified', ['name' => $request->name]));

        \Cache::forget('laravelticket::statuses');

        return redirect()->action('\Binshops\LaravelTicket\Controllers\StatusesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $name = $status->name;
        $status->delete();

        Session::flash('status', trans('laravelticket::lang.status-name-has-been-deleted', ['name' => $name]));

        \Cache::forget('laravelticket::statuses');

        return redirect()->action('\Binshops\LaravelTicket\Controllers\StatusesController@index');
    }
}
