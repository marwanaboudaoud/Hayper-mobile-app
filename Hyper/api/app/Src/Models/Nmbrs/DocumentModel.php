<?php


namespace App\Src\Models\Nmbrs;

class DocumentModel
{
    /**
     * @var int
     */
    private $employeeId;

    /**
     * @var string
     */
    private $documentName;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $guid;

    /**
     * @var string
     */
    private $documentType;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @return int
     */
    public function getEmployeeId(): ?int
    {
        return $this->employeeId;
    }

    /**
     * @param int $employeeId
     * @return DocumentModel
     */
    public function setEmployeeId(?int $employeeId): DocumentModel
    {
        $this->employeeId = $employeeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentName(): ?string
    {
        return $this->documentName;
    }

    /**
     * @param string $documentName
     * @return DocumentModel
     */
    public function setDocumentName(?string $documentName): DocumentModel
    {
        $this->documentName = $documentName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return DocumentModel
     */
    public function setBody(?string $body): DocumentModel
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getGuid(): ?string
    {
        return $this->guid;
    }

    /**
     * @param string $guid
     * @return DocumentModel
     */
    public function setGuid(?string $guid): DocumentModel
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentType(): ?string
    {
        return $this->documentType;
    }

    /**
     * @param string $documentType
     * @return DocumentModel
     */
    public function setDocumentType(?string $documentType): DocumentModel
    {
        $this->documentType = $documentType;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return DocumentModel
     */
    public function setUserId(?int $user_id): DocumentModel
    {
        $this->user_id = $user_id;
        return $this;
    }
}
