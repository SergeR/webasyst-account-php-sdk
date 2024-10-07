<?php

namespace SergeR\WebasystAccountSDK\Contracts\Developer;

use DateTimeInterface;

interface PromocodeInterface
{
    public function getCode(): string;

    public function getPercent(): int;

    /**
     * @return string[]
     */
    public function getProducts(): array;

    public function getType(): ?string;

    public function getStartDate(): ?DateTimeInterface;

    public function getEndDate(): ?DateTimeInterface;

    public function getDescription(): string;
}
