<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\TimeEntries;

class TimeEntriesController extends Controller
{
    public function index()
    {
        $time = TimeEntries::with('user')->get();

        return $time;
    }

    public function store()
    {
        $data = Request::all();

        $timeentry = new TimeEntries();

        $timeentry->fill($data);

        $timeentry->save();

    }

    public function update($id)
    {
        $timeentry = TimeEntries::find($id);

        $data = Request::all();

        $timeentry->fill($data);

        $timeentry->save();

    }

    public function destroy($id)
    {
        $timeentry = TimeEntries::find($id);

        $timeentry->delete();
    }
}
