<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backup;
use App\Services\BackupService;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function index(Request $request)
    {
        $data = Backup::with('creator:id,name')->paginate(10);
        return view('admin.backup.index', compact('data'));
    }

    public function backup(Request $request)
    {
        $backup = BackupService::backupDatabase();

        if(array_key_exists('error', $backup) && $backup['error']) {
            return back()->with('error', $backup['error']);
        }
        Backup::create([
            'name' => 'backup',
            'file_path' => $backup['path'],
            'file_size' => filesize($backup['path']),
            'checksum' => md5_file($backup['path']),
            'created_by' => auth()->guard('admin')->user()->id,
            'backup_at' => now(),
        ]);
        notyf()->success($backup['message']);
        return back();
    }

    public function download(Request $request, $id)
    {
        $backup = Backup::findOrFail($id);
        return response()->download($backup->file_path);
    }
}
