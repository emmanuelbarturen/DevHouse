<?php namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 25/06/2017
 * Time: 11:40 AM
 */
trait ManageFile
{


    /**
     * @param UploadedFile $file
     * @param $userId
     * @param string $disc
     * @return false|string
     */
    public function storeFile(UploadedFile $file, $userId, $disc = 'local')
    {
        return $file->storePubliclyAs('/' . $userId,
            uniqid($userId . '_' . time() . '_') . '.' . $file->getClientOriginalExtension(), $disc);
    }

    /**
     * @param array $files
     * @param $userId
     * @param string $disc
     * @return array
     */
    public function storeManyFiles(array $files, $userId, $disc = 'local')
    {
        $pathsFiles = [];

        foreach ($files as $file) {
            $pathsFiles[] = $this->storeFile($file, $userId, $disc);
        }

        return $pathsFiles;
    }

    /**
     * @param $path
     * @param $name
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($path, $name)
    {
        $headers = [
            'Content-Disposition' => 'attachment;'
        ];

        return response()->download($path, $name, $headers);
    }

    /**
     * @param $path
     * @return mixed
     */
    public function removeFile($path)
    {
        return File::delete($path);
    }

    /**
     * @param array $filesPaths
     */
    public function removeManyFiles(array $filesPaths)
    {
        foreach ($filesPaths as $path) {
            $this->removeFile($path);
        }
    }
}