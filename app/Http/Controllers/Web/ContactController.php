<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function dashboard(Request $request)
    {
        $auth = Auth::user();
        $data = [];
        $current_year = Carbon::now()->year;

        $monthly_submissions = Contact::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->whereYear('created_at', $current_year)
            ->where('user_id', $auth->id)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month')
            ->map(function ($item) {
                return $item->count;
            });

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $result = [];

        foreach ($months as $index => $month) {
            $monthNumber = $index + 1;
            $result[] = [
                'month' => $month,
                'count' => $monthly_submissions[$monthNumber] ?? 0,
            ];
        }

        $resultJson = json_encode($result);
        return view('dashboard', compact('resultJson'));
    }

    public function index()
    {
        return view('contact');
    }

    public function fetchContacts(Request $request)
    {
        $auth = Auth::user();
        if ($request->ajax()) {
            $contact = Contact::select('*')->where('user_id', $auth->id)->orderBy('id', 'DESC')->get();
            return datatables()->of($contact)->make(true);
        }
    }

    public function updateContactStatus(Request $request, $id)
    {
        $auth = Auth::user();
        try {
            $contact = Contact::where('user_id', $auth->id)->where('id', $id)->firstOrFail();
            $contact->update([
                'status' => $contact->status == 'Active' ? 'Inactive' : 'Active'
            ]);
            return response()->json(['status' => 'success', 'message' => 'Status successfully updated', 'data' => $contact], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateStage(Request $request, $id)
    {
        $auth = Auth::user();
        try {
            $contact = Contact::where('user_id', $auth->id)->where('id', $id)->firstOrFail();
            $contact->update([
                'stage' => $contact->stage == 'New' ? 'Old' : 'New'
            ]);
            return response()->json(['status' => 'success', 'message' => 'Stage successfully updated', 'data' => $contact], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function previewContact(Request $request, $id) 
    {
        $auth = Auth::user();
        try {
            $contact = Contact::where('user_id', $auth->id)->where('id', $id)->firstOrFail();
            return response()->json(['status' => 'success', 'message' => 'Data successfully fetched',
            'data'=>$contact], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Internal server error'], 500);
        }
    }

    public function deleteContact(Request $request)
    {
        $auth = Auth::user();
        $validate = $request->validate([
            'deleteContact' => 'required|integer'
        ]);
        try {
            $contact = Contact::where('id', $request->deleteContact)->where('user_id', $auth->id)->first();
            $contact->delete();
            return response()->json(['status' => 'success', 'message' => 'Data successfully deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Internal server error'], 500);
        }
    }
}
