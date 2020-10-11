<?php


namespace controller;


use model\service\impl\ServiceTypeService;

class ServiceTypeController {
    use InvalidOrNoDataResponse;

    private ServiceTypeService $service;
    private string $requestMethod;

    /**
     * ServiceTypeController constructor.
     * @param string $requestMethod
     */
    public function __construct(string $requestMethod) {
        $this->requestMethod = $requestMethod;
        $this->service = new ServiceTypeService();
    }

    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->findAllRequest();
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

    public function findAllRequest() {
        $result = $this->service->getAllServiceTypes();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
}