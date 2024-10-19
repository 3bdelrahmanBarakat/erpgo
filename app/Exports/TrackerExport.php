<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\ProductServiceCategory;
use App\Models\TimeTracker;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrackerExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $data = TimeTracker::query()
            ->get()
            ->map(function ($tracker) {
                return [
                    'ID' => $tracker->id,
                    'Task' => $tracker->project_task,
                    'Project' => $tracker->project_name,
                    'Date' => date('Y-m-d', strtotime($tracker->created_at)),
                    'Start Time' => date('H:i:s', strtotime($tracker->start_time)),
                    'End Time' => date('H:i:s', strtotime($tracker->end_time)),
                    'Total Time' => $tracker->total,
                    'Created By' => $tracker->createdBy->name,
                ];
            });

        return $data;
    }

    public function headings(): array
    {
        return [
            "ID",
            "Task",
            "Project",
            "Date",
            "Start Time",
            "End Time",
            "Total Time",
            "Created By"
        ];
    }
}
