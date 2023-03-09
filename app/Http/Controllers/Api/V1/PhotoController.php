<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PhotoRepository;
use App\Http\Resources\PhotoResource;
use App\Http\Resources\PhotoCollection;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    protected $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function index()
    {
        $photos = $this->photoRepository->getAllPhotos();
        return new PhotoCollection($photos);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $photo = $this->photoRepository->insertPhotoRow($data);
        return new PhotoResource($photo);
    }


    public function show($id)
    {
        $photo = $this->photoRepository->getPhotoById($id);
        return new PhotoResource($photo);
    }




    public function update(Photo $photo, Request $request)
    {
        $data = $request->all();
        $newPhoto = $this->photoRepository->updatePhotoRow($photo, $data);
        return new PhotoResource($newPhoto);
    }


    public function destroy($id)
    {
        $photo = $this->photoRepository->getPhotoById($id);
        if (!is_object($photo)) {
            return "Invalid ID";
        }
        $result = $this->photoRepository->deletePhotoRow($photo);
        return response()->json([
            "message" => $result
        ]);
    }
}
