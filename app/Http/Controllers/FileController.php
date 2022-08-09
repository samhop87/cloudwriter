<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Interfaces\DriveApiInterface;
use App\Models\File;
use Google\Service\Drive\DriveFile;

/**
 * Class FileController
 *
 * Manages individual files in project tree
 */
class FileController extends Controller
{
    /**
     * @var DriveApiInterface
     */
    private DriveApiInterface $googleDriveApiService;

    /**
     * @param DriveApiInterface $googleDriveApiService
     */
    public function __construct(DriveApiInterface $googleDriveApiService)
    {
        $this->googleDriveApiService = $googleDriveApiService;
    }

    /**
     * @param CreateFileRequest $request
     * @return DriveFile
     */
    public function create(CreateFileRequest $request): DriveFile
    {
        return $this->googleDriveApiService->createFile($request->folder_id, $request->name);
    }

    /**
     * @param File $file
     * @return mixed
     */
    public function show(File $file): mixed
    {
        return $this->googleDriveApiService->getFile($file->file_id);
    }

    /**
     * @param File $file
     * @param UpdateFileRequest $request
     * @return mixed
     */
    public function update(File $file, UpdateFileRequest $request): mixed
    {
        return $this->googleDriveApiService->updateFile($file->file_id, $request->text);
    }

    /**
     * @param File $file
     * @return mixed
     */
    public function delete(File $file): mixed
    {
        return $this->googleDriveApiService->deleteFile($file->file_id);
    }
}
