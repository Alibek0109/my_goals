<?php

namespace App\Http\Controllers\Home;

use App\Models\DailyPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyController extends ConfigController
{
    public function index()
    {
        $dailyModel = DailyPlan::where('user_id', Auth::id())->get();
        $nowTime = Carbon::now()->isoFormat("DD MMMM");

        return view('home.daily.index', ['data' => $dailyModel, 'nowTime' => $nowTime]);
    }

    public function create()
    {
        return view('home.daily.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'max:255',
            'user_id' => '',
            'done' => '',
        ]);

        $dailyCreate = DailyPlan::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
            'done' => 0,
        ]);

        return redirect()->route('home.daily.index')->with('success', 'Goal created successfully');
    }

    public function doneChange($id)
    {
        $dailyCheckDone = DailyPlan::find($id)->done;
        if ($dailyCheckDone == 0) {
            DailyPlan::where('id', $id)->where('user_id', Auth::id())->update(['done' => 1]);
        } elseif ($dailyCheckDone == 1) {
            DailyPlan::where('id', $id)->where('user_id', Auth::id())->update(['done' => 0]);
        }

        return redirect()->route('home.daily.index');
    }

    public function edit($id) {
        $dailyColumn = DailyPlan::find($id);
        return view('home.daily.edit', ['update_id' => $id, 'data' => $dailyColumn]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'description' => '',
        ]);

        $dailyUpdate = DailyPlan::find($id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('home.daily.index')->with('success', 'Goal updated successfully');
    }

    public function destroy($id)
    {
        DailyPlan::destroy($id);
        return redirect()->route('home.daily.index')->with('success', "Goal deleted successfully");
    }

    public function doneDestroy() {
        DailyPlan::where('user_id', Auth::id())->where('done', 1)->where('deleted_at', null)->delete();
        return redirect()->route('home.daily.index')->with('success', "Completed goals was deleted successfully");
    }

    public function allDestroy() {
        DailyPlan::where('user_id', Auth::id())->where('deleted_at', null)->delete();
        return redirect()->route('home.daily.index')->with('success', "All goals was deleted successfully");
    }

    public function recycle_bin() {
        $dailyTrashed = DailyPlan::onlyTrashed()->where('user_id', Auth::id())->get();
        $restoreDateSession =  DailyPlan::onlyTrashed()->whereDate("updated_at", '<=', Carbon::now()->subDays(1))
        ->where('user_id', Auth::id())
        ->where('deleted_at', '!=', null)
        ->restore();
        // 2022-02-26 07:17:05
        return view("home.daily.recycle_bin", ['data' => $dailyTrashed]);
    }

    public function recycle_bin_restore($id) {
        DailyPlan::withTrashed()->where('id', $id)->restore();
        return redirect()->route('home.daily.index')->with('success', 'Data was restored successfully');
    }

    public function recycle_bin_destroy($id) {
        DailyPlan::where('id', $id)->forceDelete();
        return redirect()->route('home.daily.recycle_bin')->with('success', 'Data was clear successfully');
    }

    public function recycle_bin_restore_all() {
        DailyPlan::where('user_id', Auth::id())->where('deleted_at', '!=', null)->restore();
        return redirect()->route('home.daily.index')->with('success', 'All data restored successfully');
    }

    public function recycle_bin_destroy_all() {
        DailyPlan::where('user_id', Auth::id())->where('deleted_at', '!=', null)->forceDelete();
        return redirect()->route('home.daily.recycle_bin')->with('success', 'Cleared');
    }
}
