<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Interfaces\DriveApiInterface;
use App\Models\File;
use Google\Service\Drive\DriveFile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
     * @param  DriveApiInterface  $googleDriveApiService
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
     * @param  CreateFileRequest  $request
     * @return DriveFile
     */
    public function create(CreateFileRequest $request): DriveFile
    {
        return $this->googleDriveApiService->createFile(folder_id: $request->folder_id, title: $request->title);
    }

    /**
     * @param $file_id
     *
     * @throws \Google\Exception
     */
    public function show($file_id): Redirector|Application|RedirectResponse
    {
        $this->googleDriveApiService->refreshSessionFile($file_id);

        return redirect(route('project.file.edit'));
    }

    /**
     * @param UpdateFileRequest $request
     * @return mixed
     */
    public function update(UpdateFileRequest $request): mixed
    {
        return $this->googleDriveApiService->updateFile(file_id: $request->file_id, file_text: $request->text);
    }

    /**
     * @param  File  $file
     * @return mixed
     */
    public function delete(): mixed
    {
        // TODO: make this a redirect to the project page
        return $this->googleDriveApiService->deleteFile(request()->id);
    }
}
