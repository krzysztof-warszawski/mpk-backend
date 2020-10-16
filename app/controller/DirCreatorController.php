<?php


namespace controller;


use model\service\impl\DirCreatorService;

class DirCreatorController {
    use InvalidOrNoDataResponse;

    private int $id;
    private string $requestMethod;
    private DirCreatorService $dirCreatorService;

    /**
     * DirCreatorController constructor.
     * @param int $id
     * @param string $requestMethod
     */
    public function __construct(int $id, string $requestMethod) {
        $this->id = $id;
        $this->requestMethod = $requestMethod;
        $this->dirCreatorService = new DirCreatorService();
    }


    public function processRequest() {
        switch ($this->requestMethod) {
            case 'POST':
                $response = $this->createDirRequest();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        header("Content-Type: application/json; charset=UTF-8");
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function createDirRequest() {
        // TODO remove @ before prod and after handling errors and warnings reporting
        $result = @$this->dirCreatorService->createDirectories($this->id);
        if (!$result) {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode([
                'info' => "Couldn't create directories. Please check whether they have already been created."
            ]);
        } else {
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;
        }
        return $response;
    }


}