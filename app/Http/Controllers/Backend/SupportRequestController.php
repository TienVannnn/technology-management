<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupportRequest;
use App\Http\Services\SupportRequestService;
use App\Jobs\ReplyRequestJob;
use App\Models\Customer;
use App\Models\Department;
use App\Models\ReplyRequest;
use App\Models\RequestChange;
use Illuminate\Http\Request;
use App\Models\SupportRequest as ModelSuportRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SupportRequestController extends Controller
{
    protected $rs;
    use AuthorizesRequests;
    public function __construct(SupportRequestService $request)
    {
        $this->rs = $request;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('list supportrequest');
        $requests = $this->rs->getSupportRequests();
        $departments = Department::orderByDesc('id')->get();
        $title = 'List of support requests';
        $keyword = $request->input('keyword');
        $departmentId = $request->input('department_id');
        $status = $request->input('status', null);
        $fromDate = $request->input('from_date') ?? null;
        $toDate = $request->input('to_date') ?? null;
        return view('backend.request-support.list', compact('title', 'requests', 'departments', 'keyword', 'departmentId', 'status', 'fromDate', 'toDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('add supportrequest');
        $title = 'Create a new support request';
        $customers = Customer::orderByDesc('id')->get();
        $departments = Department::orderByDesc('id')->get();
        return view('backend.request-support.create', compact('title', 'customers', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupportRequest $request)
    {
        $this->authorize('add supportrequest');
        $this->rs->createSupportRequest($request);
        return redirect()->route('support-request.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sr = $this->rs->viewSR($id);
        $title = 'Chi tiết yêu cầu';
        return view('backend.request-support.request_detail', compact('sr', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('edit supportrequest');
        $sr = ModelSuportRequest::find($id);
        if (!$sr) abort(404);
        $customers = Customer::orderByDesc('id')->get();
        $departments = Department::orderByDesc('id')->get();
        $title = 'Edit support request';
        return view('backend.request-support.edit', compact('title', 'customers', 'departments', 'sr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupportRequest $request, string $id)
    {
        $this->authorize('edit supportrequest');
        $sr = ModelSuportRequest::find($id);
        if (!$sr) abort(404);
        $this->rs->updateSupportRequest($request, $sr);
        return redirect()->route('support-request.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete supportrequest');
        try {
            $sr = ModelSuportRequest::find($id);
            if (!$sr) abort(404);
            $sr->delete();
        } catch (\Exception $e) {
            Session::flash('error', 'Support request delete failed: ' . $e->getMessage());
        }
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $departmentId = $request->input('department_id');
        $status = $request->input('status');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = ModelSuportRequest::query();

        if (!empty($keyword)) {
            $query->where('support_request', 'LIKE', '%' . $keyword . '%');
        }

        if (!empty($departmentId)) {
            $query->where('department_id', $departmentId);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($fromDate)) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if (!empty($toDate)) {
            $query->whereDate('created_at', '<=', $toDate);
        }
        $requests = $query->with(['customer', 'department'])->paginate(10);

        $departments = Department::all();
        return view('backend.request-support.list', [
            'requests' => $requests,
            'departments' => $departments,
            'keyword' => $keyword ?? '',
            'departmentId' => $departmentId ?? null,
            'status' => $status ?? '',
            'fromDate' => $fromDate ?? '',
            'toDate' => $toDate ?? '',
        ]);
    }

    public function history(Request $request)
    {
        $this->authorize('list requestchange');
        $fromDate = $request->input('from_date', null);
        $toDate = $request->input('to_date', null);
        $title = 'Lịch sử thay đổi yêu cầu hỗ trợ';
        $changes = RequestChange::orderByDesc('created_at')->paginate(10);
        return view('backend.request-support.history', compact('title', 'changes', 'fromDate', 'toDate'));
    }

    public function history_detail($id)
    {
        $this->authorize('list requestchange');
        $requestchange = RequestChange::find($id);
        if (!$requestchange) abort(404);
        $title = 'Chi tiết thay đổi';
        return view('backend.request-support.history_detail', compact('title', 'requestchange'));
    }

    public function search_history(Request $request)
    {
        $fromDate = $request->input('from_date', null);
        $toDate = $request->input('to_date', null);
        $query = RequestChange::query();
        if ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        }
        $changes = $query->orderByDesc('created_at')->paginate(10);
        $title = 'Lịch sử thay đổi yêu cầu hỗ trợ';
        return view('backend.request-support.history', compact('changes', 'title', 'fromDate', 'toDate'));
    }

    public function markRequestsRead()
    {
        ModelSuportRequest::where('is_new', true)->update(['is_new' => false]);
        return response()->json(['success' => true]);
    }

    public function confirm($id)
    {
        $module = ModelSuportRequest::find($id);
        if (!$module) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy yêu cầu này'
            ]);
        }
        $module->update(['status' => 1]);
        return response()->json([
            'status' => 200,
            'message' => 'Trạng thái đã được xác nhận'
        ]);
    }

    public function cancle($id)
    {
        $module = ModelSuportRequest::find($id);
        if (!$module) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tìm thấy yêu cầu này'
            ]);
        }
        $module->update(['status' => -1]);
        return response()->json([
            'status' => 200,
            'message' => 'Trạng thái đã được hủy'
        ]);
    }

    public function reply($id)
    {
        $sr = ModelSuportRequest::find($id);
        if (!$sr) abort(404);
        $title = 'Liên hệ ' . $sr->title;
        return view('backend.request-support.reply', compact('title', 'sr'));
    }

    public function handle_reply(Request $request)
    {
        try {
            $sr = ModelSuportRequest::find($request->id);
            if (!$sr) abort(404);
            $title = $request->title;
            $content = $request->content;
            ReplyRequest::create([
                'title' => $title,
                'content' => $content,
                'user_id' => Auth::user()->id,
                'sr_id' => $sr->id
            ]);
            Session::flash('success', 'Gửi thư thành công');
            ReplyRequestJob::dispatch($title, $request->email, $content)->delay(now()->addSecond(10));
            return redirect()->route('support-request.show', $sr->id);
        } catch (\Exception) {
            Session::flash('error', 'Có lỗi xảy ra khi gửi');
            return redirect()->back();
        }
    }
}
