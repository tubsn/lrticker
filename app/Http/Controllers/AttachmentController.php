<?php

namespace App\Http\Controllers;

use App\models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;


class AttachmentController extends Controller
{

    public function index(){
        return Attachment::all();
    }

    public function create(){
        //
    }

    public function store(Request $request){

		if (!$request->hasFile('files')) {
			abort(400, 'No Files Uploaded');
		}

		$files = $request->file('files');

		$newAttachments = [];

		foreach ($request->file('files') as $file) {

			$fileInfos = $this->collect_info($file);
			$fileInfos['url'] = $file->store('img','uploads');
			$newAttachment = Attachment::create($fileInfos);
			$newAttachment->save();
			array_push($newAttachments, ['id' => $newAttachment->id, 'url' => $newAttachment->url]);
		}

		return $newAttachments;

    }

    public function show(Attachment $attachment){
        //
    }

    public function edit(Attachment $attachment){
        //
    }

    public function update(Request $request, Attachment $attachment){
        //
    }

    public function destroy(Attachment $attachment){
        //
    }


	private function collect_info(UploadedFile $file) {
		return [
			'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
			'filename' => $file->getClientOriginalName(),
			'extension' => $file->getClientOriginalExtension(),
			'type' => $file->getMimeType(),
			'size' => $file->getSize(),
			'url' => null,
		];
	}


}
