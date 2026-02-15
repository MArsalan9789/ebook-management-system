<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{
    /* ============================================================
     | USER SIDE FUNCTIONS
     | These methods are used on frontend by authenticated users
     |=============================================================
    */

    /**
     * Display all competitions on user side
     */
    public function index()
    {
        $competitions = Competition::with(['submissions' => function ($q) {
            $q->where('status', 'winner');
        }])->latest()->get();

        return view('user.competitions', compact('competitions'));
    }

    /**
     * Handle competition submission by user
     */
    public function submit(Request $request, $id)
    {
        // Validate uploaded file

        // Store file in storage/app/public/submissions
        $path = $request->file('file')->store('submissions', 'public');


        //    Save submission record
        Submission::create([
            'competition_id' => $id,
            'user_id'        => Auth::id(),
            'file'           => $path,
            'status'         => 'submitted',
        ]);

        return redirect()
            ->route('competitions')
            ->with('success', 'Submission uploaded successfully!');
    }



// function submit1(Request $req,$id){

//         $path = $req->file('file')->store('submissions', 'public');
// Submission::create([
//             'competition_id' => $id,
//             'user_id'        => Auth::id(),
//             'file'           => $path,
//             'status'         => 'submitted',
//         ]);

//         return redirect()
//             ->route('competitions')
//             ->with('success', 'Submission uploaded successfully!');

// }


    /* ============================================================
     | ADMIN SIDE FUNCTIONS
     | These methods are used inside admin panel
     |=============================================================
    */

    /**
     * Admin: Display list of competitions
     */
    public function adminIndex()
    {
        $competitions = Competition::latest()->get();
        return view('admin.competitions.index', compact('competitions'));
    }

    /**
     * Admin: Show competition create form
     */
    public function create()
    {
        return view('admin.competitions.create');
    }

    /**
     * Admin: Store new competition
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'type'     => 'required|string|max:50',
            'end_date' => 'required|date',
            'prize'    => 'nullable|string|max:255',
        ]);

        Competition::create(
            $request->only(['title', 'type', 'end_date', 'prize'])
        );

        return redirect()
            ->route('competitionlist')
            ->with('success', 'Competition created successfully!');
    }

    /**
     * Admin: Show competition edit form
     */
    public function edit($id)
    {
        $competition = Competition::findOrFail($id);
        return view('admin.competitions.edit', compact('competition'));
    }

    /**
     * Admin: Update competition details
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'type'     => 'required|string|max:50',
            'end_date' => 'required|date',
            'prize'    => 'nullable|string|max:255',
        ]);

        $competition = Competition::findOrFail($id);
        $competition->update(
            $request->only(['title', 'type', 'end_date', 'prize'])
        );

        return redirect()
            ->route('competitionlist')
            ->with('success', 'Competition updated successfully!');
    }

    /**
     * Admin: Delete a competition
     */
    public function destroy($id)
    {
        Competition::findOrFail($id)->delete();

        return redirect()
            ->route('competitionlist')
            ->with('success', 'Competition deleted successfully!');
    }

    /**
     * Admin: View submissions of a specific competition
     */
    public function submissions($competition_id)
    {
        $competition = Competition::findOrFail($competition_id);

        $submissions = $competition
            ->submissions()
            ->with('user')
            ->latest()
            ->get();

        return view(
            'admin.competitions.submissions',
            compact('competition', 'submissions')
        );
    }

    /**
     * Admin: Mark a submission as winner
     */
    public function selectWinner($submission_id)
    {
        $submission = Submission::findOrFail($submission_id);
        $submission->update(['status' => 'winner']);

        return back()->with('success', 'Winner selected successfully!');
    }
}
