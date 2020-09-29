<?php


namespace controller;

use model\service\impl\ProjectService;

class ProjectController extends CRUDController {
    use InvalidOrNoDataResponse;

    /**
     * ProjectController constructor.
     * @param string $requestMethod
     * @param int $id
     */
    public function __construct(string $requestMethod, int $id = null) {
        parent::__construct($requestMethod, $id);
        $this->service = new ProjectService();
    }


    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->id !== null) {
                    $response = $this->findOneRequest();
                } else {
                    $response = $this->findAllRequest();
                }
                break;
            case 'POST':
                // TODO
                break;
            case 'PUT':
                // TODO
                break;
            case 'DELETE':
                $response = $this->deleteRequest();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }


    protected function findAllRequest() {
        $result = $this->service->getAllProjectsList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    protected function findOneRequest() {
        $result = $this->service->getProjectById($this->id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    protected function createRequest() {
        // TODO: Implement createRequest() method.
    }

    protected function updateRequest() {
        // TODO: Implement updateRequest() method.
    }

    protected function deleteRequest() {
        $result = $this->service->deleteProject($this->id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    protected function validateInput() {
        // TODO: Implement validateInput() method.
    }
}
