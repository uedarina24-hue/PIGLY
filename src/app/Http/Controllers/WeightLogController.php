<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep2Request;
use App\Http\Requests\WeightLogRequest;
use App\Http\Requests\GoalSettingRequest;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;

class WeightLogController extends Controller
{

    private function targetUser(): User
    {

        return auth()->user();
    }


    public function showRegisterStep2()
    {
        $user = $this->targetUser();
        $latestLog = $user->weightLogs()->latest()->first();
        $goal = $user->weightGoal;

        return view('auth.register_step2', compact('user', 'latestLog', 'goal'));
    }

    public function storeRegisterStep2(RegisterStep2Request $request)
    {
        $user = $this->targetUser();

        WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'weight' => $request->latest_weight,


            'calories' => 0,
            'exercise_time' => 0,
            'exercise_content' => '',
        ]);

        WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('weight_logs.index');
    }


    public function index()
    {
        $user = $this->targetUser();

        $weightLogs = $user->weightLogs()->latest()->paginate(8);
        $latestLog = $user->weightLogs()->latest()->first();
        $goal = $user->weightGoal;

        return view('weight_logs.index', compact('weightLogs', 'latestLog', 'goal'));
    }

    public function search(Request $request)
    {
        $user = $this->targetUser();

        $query = $user->weightLogs();

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $weightLogs = $query->latest()->paginate(8);
        $latestLog = $user->weightLogs()->latest()->first();
        $goal = $user->weightGoal;

        return view('weight_logs.index', compact('weightLogs', 'latestLog', 'goal'));
    }

    public function store(WeightLogRequest $request)
    {
        $user = $this->targetUser();

        WeightLog::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index');
    }

    public function edit(WeightLog $weightLog)
    {
        return view('weight_logs.edit', compact('weightLog'));
    }

    public function update(WeightLogRequest $request, WeightLog $weightLog)
    {
        $weightLog->update($request->validated());
        return redirect()->route('weight_logs.index');
    }

    public function destroy(WeightLog $weightLog)
    {
        $weightLog->delete();
        return redirect()->route('weight_logs.index');
    }

    public function goalEdit()
    {
        $user = $this->targetUser();

        $target = WeightTarget::firstOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => 0]
        );

        return view('weight_logs.goal_setting', compact('target'));
    }

    public function goalUpdate(GoalSettingRequest $request)
    {
        $user = $this->targetUser();

        WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('weight_logs.index');
    }

}
