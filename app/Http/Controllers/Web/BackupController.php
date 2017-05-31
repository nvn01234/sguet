<?php

namespace App\Http\Controllers\Web;

use App\DataTables\BackupDataTable;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Response;

class BackupController extends Controller
{
    /**
     * BackupController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-system');
    }

    public function index(BackupDataTable $dataTable)
    {
        return $dataTable->render('backup.index');
    }

    public function download($file_name)
    {
        $folder_name = config('laravel-backup.backup.name');
        $path = storage_path("app/$folder_name/$file_name");

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function backup()
    {
        \Artisan::call('backup:run', [
            '--only-db' => true,
        ]);
        \Toastr::append([
            'level' => 'success',
            'title' => 'Sao lưu CSDL thành công',
        ]);
        return redirect()->route('manage.backup');
    }

    public function delete(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'file_name' => 'string|required|min:1'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }

        $file_name = $request->get('file_name');
        $folder_name = config('laravel-backup.backup.name');
        $path = storage_path("app/$folder_name/$file_name");

        if (!File::exists($path)) {
            \Toastr::append([
                'level' => 'error',
                'title' => 'Xoá tệp sao lưu thất bại',
                'message' => "Không tìm thấy tệp $file_name",
            ]);
            abort(404);
        }

        File::delete($path);

        \Toastr::append([
            'level' => 'success',
            'title' => 'Xoá tệp sao lưu thành công'
        ]);

        return redirect()->route('manage.backup');
    }
}
