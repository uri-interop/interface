<?php
declare(strict_types=1);

namespace UriInterop\Interface;

interface UriRecordNormalizer
{
    public function normalizeUri(UriRecord $uri) : UriRecord;
}
