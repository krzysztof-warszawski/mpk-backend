<?php


namespace controller;

use model\service\impl\ProjectService;

class ProjectController extends CRUDController {
    use InvalidOrNoDataResponse;

    /**
     * ProjectController constructor.
     * @param string $requestMethod
     * @param int $id
     * @param bool $isProjectsOfBuilding
     */
    public function __construct(string $requestMethod, ?int $id, bool $isProjectsOfBuilding) {
        parent::__construct($requestMethod, $id, $isProjectsOfBuilding);
        $this->service = new ProjectService();
    }


    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->id && !$this->isSpecificData) {
                    $response = $this->findOneRequest();
                } else {
                    $response = $this->findAllRequest();
                }
                break;
            case 'POST':
                $response = $this->createRequest();
                break;
            case 'PUT':
                if ($this->id !== null) {
                    $response = $this->updateRequest();
                } else {
                    $response = $this->notFoundResponse();
                }
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
        if ($this->isSpecificData) {
            $result = $this->service->getProjectsByBuildingId($this->id);
        } else {
            $result = $this->service->getAllProjectsList();
        }
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
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateInput($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->service->createProject($input);
        $response['status_code_header'] = 'HTTP/1.1 201 OK';
        $response['body'] = null;
        return $response;
    }

    protected function updateRequest() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateInput($input)) {
            return $this->unprocessableEntityResponse();
        }
        $result = $this->service->getProjectById($this->id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $this->service->updateProject($this->id, $input);
        $response['status_code_header'] = 'HTTP/1.1 201 OK';
        $response['body'] = null;
        return $response;
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

    protected function validateInput(array $input) {
        if (!is_numeric($input['mpk'])) {
            return false;
        }
        if (!is_numeric($input['projectNum'])) {
            return false;
        }
        if (!is_numeric($input['buildingId'])) {
            return false;
        }
        if (!is_numeric($input['serviceTypeId'])) {
            return false;
        }
        return true;
    }
}
