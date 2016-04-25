<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TimeEntries;

class TimeEntriesController extends Controller
{
  public function index()
  {
      $time = TimeEntries::with('user')->get();

      return $time;
  }
}
