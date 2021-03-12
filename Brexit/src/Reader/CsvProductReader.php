<?php


namespace Anguis\Brexit\Reader;


class CsvProductReader implements ProductReaderInterface
{

    protected string $path;


    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function read(): array
    {
        return array_map('str_getcsv', file($this->path));
    }
}