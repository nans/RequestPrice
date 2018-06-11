<?php

namespace Nans\RequestPrice\Api\Data;

interface RequestInterface
{
    const KEY_ID = 'request_id';
    const KEY_NAME = 'name';
    const KEY_EMAIL = 'email';
    const KEY_SKU = 'sku';
    const KEY_COMMENT = 'comment';
    const KEY_STATUS = 'status';
    const CREATED_AT = 'created_at';

    const STATUS_NEW = 0;
    const STATUS_IS_PROGRESS = 1;
    const STATUS_CLOSED = 2;

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email);

    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @param string $sku
     * @return void
     */
    public function setSku(string $sku);

    /**
     * @return string
     */
    public function getComment(): string;

    /**
     * @param string $comment
     * @return void
     */
    public function setComment(string $comment);

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int $status
     * @return void
     */
    public function setStatus(int $status);

    /**
     * @return string
     */
    public function getCreatedAt(): string;
}