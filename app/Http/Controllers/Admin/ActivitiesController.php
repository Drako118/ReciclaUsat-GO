<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Maintenance;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $activities = Activity::where('schedule_id', $scheduleId)->get();
        return view('admin.activities.index', compact('activities', 'schedule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        return view('admin.activities.create', compact('schedule'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $scheduleId)
    {

        $request->validate([
            'date' => 'required|date',
            'description' => 'required',
        ]);
        $schedule = Schedule::findOrFail($scheduleId);
        $maintenance = Maintenance::findOrFail($schedule->maintenance_id);

        // Validar que la fecha de la actividad coincida con el día del horario
        $dayOfWeek = date('l', strtotime($request->date)); // Obtener el día de la semana en inglés

        // Convertir el día de la semana a español
        $daysInSpanish = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miércoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sábado',
            'Sunday' => 'domingo',
        ];

        if (strtolower($daysInSpanish[$dayOfWeek]) !== strtolower($schedule->day)) {
            return redirect()->back()->with('error', 'La fecha de la actividad no coincide con el día del horario.');
        }

        // Validar que la fecha de la actividad esté dentro del rango de fechas del mantenimiento
        $dateInitial = strtotime($maintenance->date_initial);
        $dateEnd = strtotime($maintenance->date_end);
        $activityDate = strtotime($request->date);

        if ($activityDate < $dateInitial || $activityDate > $dateEnd) {
            return redirect()->back()->with('error','La fecha de la actividad está fuera del rango de fechas del mantenimiento.');
        }

        $activity = new Activity($request->all());
        $activity->schedule_id = $scheduleId;
        $activity->save();

        return redirect()->route('admin.activities.index', $scheduleId)->with('success', 'Actividad registrada');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($scheduleId, $id)
    {
        $activity = Activity::findOrFail($id);
        $schedule = Schedule::findOrFail($scheduleId);
        return view('admin.activities.edit', compact('activity', 'schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $scheduleId, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->all());

        return redirect()->route('admin.activities.index', $scheduleId)->with('success', 'Actividad actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($scheduleId, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('admin.activities.index', $scheduleId)->with('success', 'Actividad eliminada');
    }
}
