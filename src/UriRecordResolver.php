<?php
declare(strict_types=1);

namespace UriInterop\Interface;

interface UriRecordResolver
{
    public function resolveUri(
        UriRecord $relative,
        UriRecord $base,
    ) : UriRecord;
}
