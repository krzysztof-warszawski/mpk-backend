<?php


namespace controller;


abstract class CRUDController {

    protected $service;
    protected string $requestMethod;
    protected ?int $id;
    protected bool $isSpecificData;

    /**
     * CRUDController constructor
     * @param string $requestMethod
     * @param int|null $id
     * @param bool $isSpecificData
     */
    public function __construct(string $requestMethod, ?int $id, bool $isSpecificData) {
        $this->requestMethod = $requestMethod;
        $this->id = $id;
        $this->isSpecificData = $isSpecificData;
    }

    abstract public function processRequest();

    abstract protected function findAllRequest();

    abstract protected function findOneRequest();

    abstract protected function createRequest();

    abstract protected function updateRequest();

    abstract protected function deleteRequest();

    abstract protected function validateInput(array $input);
}
