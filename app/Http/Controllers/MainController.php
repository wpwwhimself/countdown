<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Occurence;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function clocks()
    {
        $clocks = [];

        return view('clocks', compact(
            "clocks",
        ));
    }

    #region modals
    public function addEntry(Request $rq)
    {
        Entry::create([
            "name" => $rq->name,
            "subject_id" => $rq->subject_id,
        ]);

        return back()->with("toast", ["success", "Dodano wpis"]);
    }

    public function addOccurence(Request $rq)
    {
        Occurence::create([
            "date" => $rq->date,
            "entry_id" => $rq->entry_id,
        ]);

        return back()->with("toast", ["success", "Dodano wystąpienie"]);
    }
    #endregion
}
