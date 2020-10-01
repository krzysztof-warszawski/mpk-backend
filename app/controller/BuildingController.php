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
                // TODO: Implement
                break;
            case 'PUT':
                // TODO: Implement
                break;
            case 'DELETE':
                // TODO: Implement and DELETE OFFER Project that belongs to this building
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
        // TODO: Implement createRequest() method.
    }

    protected function updateRequest() {
        // TODO: Implement updateRequest() method.
    }

    protected function deleteRequest() {
        // TODO: Implement deleteRequest() method.
    }

    protected function validateInput(array $input) {
        // TODO: Implement validateInput() method.
    }
}
