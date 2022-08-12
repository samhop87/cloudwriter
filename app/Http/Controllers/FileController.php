<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Interfaces\DriveApiInterface;
use App\Models\File;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

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

    public function edit(): Response
    {
        return Inertia::render('CurrentFile', [
            'current_file' => session('current_file'),
        ]);
    }

    /**
     * @param CreateFileRequest $request
     * @return DriveFile
     */
    public function create(CreateFileRequest $request): DriveFile
    {
        return $this->googleDriveApiService->createFile(folder_id: $request->folder_id, title: $request->title);
    }

    /**
     * @param $file_id
     */
    public function show($file_id)
    {
        $file = $this->googleDriveApiService->getFile($file_id);

        $activeFile = collect([
            'id' => $file_id,
            'title' => 'test',
            'content' => $file->getBody()->getContents(),
        ]);

        session(['current_file' => $activeFile]);

        return redirect(route('project.file.edit'));
    }

    /**
     * @param File $file
     * @param UpdateFileRequest $request
     * @return mixed
     */
    public function update(UpdateFileRequest $request): mixed
    {
        return $this->googleDriveApiService->updateFile(file_id: $request->file_id, file_text: $request->text);
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
