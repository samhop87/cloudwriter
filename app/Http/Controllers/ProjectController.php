<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Interfaces\DriveApiInterface;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    private DriveApiInterface $googleDriveApiService;

    public function __construct(DriveApiInterface $googleDriveApiService)
    {
        $this->googleDriveApiService = $googleDriveApiService;
    }

    public function create(ProjectRequest $request): DriveFile
    {
        return $this->googleDriveApiService->createFolder($request->name);
    }

    public function show(): Response
    {
        $id = request()->project_id;

        // [{"id":"1IX-KpPt1ejjBgSfdCm3afCKFCBABZkHd_Pz0p2xt6sA","type":"application\/vnd.google-apps.document","title":"This is a file test"},{"id":"1rttU_TD9Y5khQU2Adn-e-YLjG-nIsnJoyNr53IDNc1A","type":"application\/vnd.google-apps.document","title":"Text Document"},{"id":"1MXbPvHCzFpxyRwz4MDqgDvy2jCEprcY1","title":"subfolder","type":"application\/vnd.google-apps.folder","content":[{"id":"1_1csCZjgmLXfXFSDn4l_8HTtt7cqL0PETjYub1qljhY","type":"application\/vnd.google-apps.document","title":"this one - neil isn't listening"},{"id":"1E9LKq718f5hQJDvKQbOkq0jyGp2G1Mh6PsOrpFEF4fU","type":"application\/vnd.google-apps.document","title":"Sam's new text"},{"id":"1LyHDYO0pZ8ThJwlaRReX_K3Zu6vFuBpCu-dNIhIFisI","type":"application\/vnd.google-apps.document","title":"this is inside a sub folder"},{"id":"1hqGsd7xzABiHwuNY57KZG1OGR09Z_ub2","title":"FOLDER INSIDE","type":"application\/vnd.google-apps.folder","content":[{"id":"1ZNGUOnghPjWmA7naWPtc2f5j7ec8ozoZG2ymzL4IMB4","type":"application\/vnd.google-apps.document","title":"this needs to work automatically on submit"},{"id":"1r6d-HTsnk5zRSnbuyn8izDTW56eorA_uxb4r8EdC-Ms","type":"application\/vnd.google-apps.document","title":"neato!"},{"id":"1aXCeTFh9-1Z0CwgFql-ovyXEMbPpPLavMCB98ezhViE","type":"application\/vnd.google-apps.document","title":"EVEN deeper"}]}]}]

        return Inertia::render('OpenProject', [
            'project' => $this->googleDriveApiService->retrieveProject($id),
        ]);
    }

    public function delete($id)
    {
        return $this->googleDriveApiService->deleteFile($id);
    }
}
