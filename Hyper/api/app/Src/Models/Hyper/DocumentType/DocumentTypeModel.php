<?php


namespace App\Src\Models\Hyper\DocumentType;

class DocumentTypeModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $document_type;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return DocumentTypeModel
     */
    public function setId(?int $id): DocumentTypeModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DocumentTypeModel
     */
    public function setName(?string $name): DocumentTypeModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentType(): ?string
    {
        return $this->document_type;
    }

    /**
     * @param string $document_type
     * @return DocumentTypeModel
     */
    public function setDocumentType(?string $document_type): DocumentTypeModel
    {
        $this->document_type = $document_type;
        return $this;
    }
}
