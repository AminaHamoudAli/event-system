<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class FileController extends Controller
{
    /**
     * رفع ملف وربطه بالحدث.
     */
    public function store(Request $request, Event $event)
    {
        // التحقق من صحة الملف
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // الحد الأقصى 10 ميغابايت
        ]);

        $file = $request->file('file');

        // تخزين الملف في مجلد public/event_files
        $path = $file->store('event_files', 'public');

        // حفظ معلومات الملف في قاعدة البيانات
        $eventFile = $event->files()->create([
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
        ]);

        // إرجاع استجابة JSON احترافية
        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'file' => $eventFile
        ]);
    }
}
