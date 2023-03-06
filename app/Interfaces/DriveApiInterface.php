<?php

namespace App\Interfaces;

use Google\Service\Drive\DriveFile;
use Google\Service\Drive\FileList;
use Illuminate\Support\Collection;

interface DriveApiInterface
{
    public function retrieveProject($folder_id): ?Collection;

    public function listFilesInFolder($folder_id): FileList;

    public function refreshProjects();

    public function getLastProject(): ?Collection;

    public function recursiveMapFolders($folder_id, Collection $projectContainer = null): ?Collection;

    public function createFolder(string $name, $folder_id = null, $order = null, $user = null): DriveFile;

    public function createFile($folder_id = null, $title = null): DriveFile;

    public function getFile($file_id);

    public function updateFile($file_id, $file_text);

    public function deleteFile($id);
}
