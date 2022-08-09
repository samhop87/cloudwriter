<?php

namespace App\Services;

use App\Interfaces\DriveApiInterface;
use App\Models\MimeTypes;
use App\Models\User;
use Google\Exception;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\FileList;
use Google\Service\RequestInterface;
use Google\Service\ResponseInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GoogleDriveApiService implements DriveApiInterface
{
    private GoogleDriveConnectionService $driveConnectionService;

    public function __construct(GoogleDriveConnectionService $driveConnectionService)
    {
        $this->driveConnectionService = $driveConnectionService;
    }

    /**
     * @param $folder_id
     * @return Collection|null
     * @throws Exception
     */
    public function retrieveProject($folder_id): ?Collection
    {
        return $this->recursiveMapFolders($folder_id, collect([]));
    }

    /**
     * @param $folder_id
     * @return FileList
     * @throws Exception
     */
    public function listFilesInFolder($folder_id): FileList
    {
        $driveService = $this->driveConnectionService->setupService(Auth::user());
        $optParams = [
            'fields' => "*",
            'q' => "'".$folder_id."' in parents"
        ];

        // This gets us all main subfolders and text files of the top-level project folder.
        return $driveService->files->listFiles($optParams);
    }

    /**
     * Checks a user's drive for manual changes and updates projects list
     *
     * @return void
     * @throws Exception
     */
    public function refreshProjects()
    {
        // TODO: this needs refactoring so it can be used for folders and docs too.
        $user = Auth::user();
        $service = $this->driveConnectionService->setupService($user);

        foreach ($user->projects as $project) {
            $item = $service->files->get($project->project_id, ["fields" => "*"])->explicitlyTrashed;
            if ($item) {
                $project->delete();
            }
        }
    }

    /**
     * This function will be used to 'lazy-load' the last project to try and make things snappier on login.
     * @return Collection|null
     * @throws Exception
     */
    public function getLastProject(): ?Collection
    {
        $project = User\Project::latest();
        return $this->retrieveProject($project->project_id);
    }

    /**
     * @param $folder_id
     * @param Collection|null $projectContainer
     * @return Collection|null
     * @throws Exception
     */
    public function recursiveMapFolders($folder_id, Collection $projectContainer = null): ?Collection
    {
        // This gets us all main subfolders and text files of the top-level project folder.
        $results = $this->listFilesInFolder($folder_id);

        foreach ($results->getFiles() as $item) {
            if ($item->getMimeType() === MimeTypes::DOCUMENT) {
                $projectContainer->push(collect([
                    'id' => $item->getId(),
                    'type' => MimeTypes::DOCUMENT,
                    'title' => $item->getName(),
                ]));
            } elseif ($item->getMimeType() === MimeTypes::FOLDER) {
                // Map into next folder down
                $projectContainer->push(collect([
                    'id' => $item->getId(),
                    'title' => $item->getName(),
                    'type' => MimeTypes::FOLDER,
                    'content' => $this->recursiveMapFolders($item->getId(), collect([])),
                ]));
            }
        }

        return $projectContainer;
    }

    /**
     * @param null $folder_id
     * @param String $name
     * @return DriveFile
     * @throws Exception
     */
    public function createFolder(string $name, $folder_id = null): DriveFile
    {
        $service = $this->driveConnectionService->setupService(Auth::user());

        // Create a new drive file instance
        $folder = new \Google_Service_Drive_DriveFile();

        // Set drive file type to folder, and set name
        $folder->setMimeType(MimeTypes::FOLDER);
        $folder->setName($name);

        // Set the parent of the folder, unless it is main project folder.
        if ($folder_id) {
            $folder->setParents([$folder_id]);
        }

        return $service->files->create($folder);
    }

    /**
     * @param $folder_id
     * @param $title
     * @return DriveFile
     * @throws Exception
     */
    public function createFile($folder_id = null, $title = null): DriveFile
    {
        $service = $this->driveConnectionService->setupService(Auth::user());

        $file = new \Google_Service_Drive_DriveFile();

        if ($title) {
            $file->setName($title);
        } else {
            $file->setName('Text Document');
        }
        $file->setMimeType(MimeTypes::DOCUMENT);

        if ($folder_id) {
            $file->setParents([$folder_id]);
        }

        $file = $service->files->create($file);

//        if ($folder_id) {
//            $this->retrieveProject()
//        }

        return $file;
    }

    /**
     * @param $file_id
     * @return RequestInterface|ResponseInterface|mixed
     * @throws Exception
     */
    public function getFile($file_id): mixed
    {
        $driveService = $this->driveConnectionService->setupService(Auth::user());
        return $driveService->files->export($file_id, 'text/html', ['alt' => 'media']);
    }

    /**
     * @throws Exception
     */
    public function updateFile($file_id, $file_text)
    {
        // Add correct meta data to allow for HTML to be passed back in format doc requires
        $fullmeta = '<meta content="text/html; charset=UTF-8" http-equiv="content-type">';
        $replacement = '<html><head><meta content="text/html; charset=UTF-8" http-equiv="content-type"></head><body style="background-color:#ffffff;padding:72pt 72pt 72pt 72pt;max-width:468pt">';
        $string = str_replace($fullmeta,$replacement,$file_text);

        $complete = $string . '</body></html>';

        $additionalParams = [
            'data' => $complete,
        ];

        $driveService = $this->driveConnectionService->setupService(Auth::user());

        // File's new metadata.
//        $file = new \Google_Service_Drive_DriveFile();
//        $file->setTitle($request->file_title);
//        $file->setDescription($request->file_description);

        $newFile = $driveService->files->update($file_id, new \Google_Service_Drive_DriveFile(), $additionalParams);
    }

    /**
     * @param $id
     * @return RequestInterface|ResponseInterface|mixed
     * @throws Exception
     */
    public function deleteFile($id): mixed
    {
        $driveService = $this->driveConnectionService->setupService(Auth::user());
        return $driveService->files->delete($id);
        // TODO: then refresh the tree, or find a way of dynamically removing the element
        // TODO: dynamically add the element. Do all the actual updating in the background.
    }
}
