<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AttachmentController extends Controller
{

    public function index(){
        return Attachment::all();
    }

    public function create(){
        //
    }

    public function store(Request $request){

		//dd($request->all());

		if (!$request->hasFile('files')) {
			abort(400, 'No Files Uploaded');
		}

		$files = $request->file('files');

		$newAttachments = [];

		foreach ($request->file('files') as $file) {

			$fileInfos = $this->collect_info($file);
			$timeStampedName = time() . '_' . $file->getClientOriginalName();

			$img = Image::make($file);
			$img->orientate();

			$maxWidth = 1080;
			$maxHeight = 1080;

			$img->height() > $img->width() ? $maxWidth=null : $maxHeight=null;
			$img->resize($maxWidth, $maxHeight, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			 });
			$img->save(Storage::disk('uploads')->path('/') . $timeStampedName);

			// Duplicate for Thumbnail
			$maxWidth = 512;
			$maxHeight = 512;

			$img->height() > $img->width() ? $maxWidth=null : $maxHeight=null;
			$img->resize($maxWidth, $maxHeight, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			 });
			$img->save(Storage::disk('thumbnails')->path('/') . $timeStampedName);

			$fileInfos['url'] = Storage::disk('uploads')->url('/') . $timeStampedName;
			$fileInfos['thumb'] = Storage::disk('thumbnails')->url('/') . $timeStampedName;

			// Laravel IMG URL without Resize
			//$fileInfos['url'] = $file->store('img','uploads');

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
