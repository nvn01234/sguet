<?php

namespace App\Http\Controllers\Web;

use App\DataTables\FeedbacksDataTable;
use App\Http\Requests\CreateFeedbackRequest;
use App\Http\Requests\FeedbackProcessRequest;
use App\Models\Feedback;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * FeedbackController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-content')->only('index', 'detail', 'delete', 'process');
    }

    public function index(FeedbacksDataTable $dataTable) {
        return $dataTable->render('feedback.index');
    }

    public function create() {
        return view('feedback.create');
    }

    public function store(CreateFeedbackRequest $request) {
        /**
         * @var Feedback $feedback
         */
        $attributes = $request->only('name', 'email', 'type', 'message');
        $attributes['ip'] = $request->ip();
        Feedback::create($attributes);
        \Toastr::append($this->thankMessage($request->get('type'), $request->has('email')));
        return redirect()->back();
    }

    private function thankMessage($type, $hasEmail) {
        $level = 'success';
        switch ($type) {
            case 0:
                $title = 'Đã gửi tin nhắn';
                $message = 'Cảm ơn bạn đã để lại tin nhắn.' . ($hasEmail ? ' Chúng tôi sẽ liên lạc với bạn sớm nhất có thể.' : '');
                break;
            case 1:
                $title = 'Đã gửi góp ý';
                $message = 'Cảm ơn bạn đã góp ý. Chúng tôi sẽ tiếp nhận góp ý và xem xét lại vấn đề.';
                break;
            case 2:
                $title = 'Đã gửi câu hỏi';
                $message = 'Cảm ơn bạn đã gửi câu hỏi. Chúng tôi sẽ cập nhật câu trả lời sớm nhất có thể.';
                break;
            case 3:case 4:
                $title = 'Đã gửi báo lỗi';
                $message = 'Cảm ơn bạn đã báo lỗi. Chúng tôi sẽ cố gắng khắc phục.';
                break;
            case 5:
                $title = 'Đã gửi nhận xét';
                $message = 'Cảm ơn bạn đã nhận xét. Hy vọng bạn tiếp tục sử dụng và đóng góp cho các sản phẩm của SGUET.';
                break;
            default:
                $title = 'Đã gửi tin nhắn';
                $message = 'Cảm ơn bạn đã liên hệ với chúng tôi.' . ($hasEmail ? ' Chúng tôi sẽ liên lạc với bạn nếu cần thiết.' : '');
                break;
        }
        return compact('level', 'title', 'message');
    }

    public function process($id, FeedbackProcessRequest $request) {
        /**
         * @var Feedback $feedback
         */
        $feedback = Feedback::findOrFail($id);
        $attributes = $request->only('status');
        $attributes['user_id'] = \Auth::id();
        $feedback->update($attributes);
        \Toastr::append([
            'message' => "Đã cập nhật trạng thái góp ý thành " . Feedback::STATUS[$feedback->status]
        ]);
        return redirect()->back();
    }

    public function delete($id) {
        /**
         * @var Feedback $feedback
         */
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        \Toastr::append([
            'message' => 'Đã chuyển góp ý vào thùng rác'
        ]);
        return redirect()->back();
    }

    public function detail($id) {
        /**
         * @var Feedback $feedback
         */
        $feedback = Feedback::findOrFail($id);
        return view('feedback.detail', compact('feedback'));
    }
}
