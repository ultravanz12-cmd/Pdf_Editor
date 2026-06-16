<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:20480'
        ]);

        $file = $request->file('pdf');

        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('uploads'), $filename);

        return redirect('/viewer/'.$filename);
    }

    public function viewer($file)
    {
        return view('viewer', compact('file'));
    }
}