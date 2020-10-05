<?php


namespace controller;

use model\service\impl\BuildingService;

class BuildingController extends CRUDController {
    use InvalidOrNoDataResponse;


    /**
     * BuildingController constructor.
     * @param string $requestMethod
     * @param int|null $id
     * @param bool $isOfferBuildings
     */
    public function __construct(string $requestMethod, ?int $id, bool $isOfferBuildings) {
        parent::__construct($requestMethod, $id, $isOfferBuildings);
        $this->service = new BuildingService();
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
                if ($this->id !== null) {
                    $response = $this->deleteRequest();
                } else {
                    $response = $this->notFoundResponse();
                }
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
            $result = $this->service->getOfferBuildingsList();
        } else {
            $result = $this->service->getAllBuildingsList();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    protected function findOneRequest() {
        $result = $this->service->getBuildingById($this->id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    protected function createRequest() {
        $input = (array) json_decode(file_get_contents('php://input'),TRUE);
        if (!$this->validateInput($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->service->createBuildingAndInitProject($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    protected function updateRequest() {
        $input = (array) json_decode(file_get_contents('php://input'),TRUE);
        if (!$this->validateInput($input)) {
            return $this->unprocessableEntityResponse();
        }
        $result = $this->service->getBuildingById($this->id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $this->service->updateBuilding($this->id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    protected function deleteRequest() {
        $result = $this->service->deleteBuilding($this->id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    protected function validateInput(array $input) {
        if (!isset($input['address'])) {
            return false;
        }
        if (!isset($input['name'])) {
            return false;
        }
        if (!isset($input['owner'])) {
            return false;
        }
        return true;
    }
}
