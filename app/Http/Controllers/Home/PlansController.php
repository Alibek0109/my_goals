<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    public function index()
    {
        $plansModel = Plans::where('user_id', Auth::id())->get();
        $nowTime = Carbon::now()->isoFormat("DD MMMM");
        return view('home.plans.index', ['nowTime' => $nowTime, 'data' => $plansModel]);
    }

    public function create()
    {
        return view('home.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'max:255',
            'user_id' => '',
            'done' => '',
        ]);

        $dailyCreate = Plans::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
            'done' => 0,
        ]);

        return redirect()->route('home.plans.index')->with('success', 'Plan created successfully');
    }

    public function doneChange($id)
    {
        $dailyCheckDone = Plans::find($id)->done;
        if ($dailyCheckDone == 0) {
            Plans::where('id', $id)->where('user_id', Auth::id())->update(['done' => 1]);
        } elseif ($dailyCheckDone == 1) {
            Plans::where('id', $id)->where('user_id', Auth::id())->update(['done' => 0]);
        }

        return redirect()->route('home.plans.index');
    }

    public function edit($id) {
        $plansColumn = Plans::find($id);
        return view('home.plans.edit', ['update_id' => $id, 'data' => $plansColumn]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'description' => '',
        ]);

        $plansUpdate = Plans::find($id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('home.plans.index')->with('success', 'Goal updated successfully');
    }

    public function destroy($id)
    {
        Plans::destroy($id);
        return redirect()->route('home.plans.index')->with('success', "Plan deleted successfully");
    }

    public function recycle_bin() {
        $dailyTrashed = Plans::onlyTrashed()->where('user_id', Auth::id())->get();
        return view("home.plans.recycle_bin", ['data' => $dailyTrashed]);
    }

    public function recycle_bin_restore($id) {
        Plans::withTrashed()->where('id', $id)->restore();
        return redirect()->route('home.plans.index')->with('success', 'Plan was restored successfully');
    }

    public function recycle_bin_destroy($id) {
        Plans::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('home.plans.recycle_bin')->with('success', 'Plan was clear successfully');
    }
}
