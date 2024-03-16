<?php

namespace App\DTO;

final class TransformerDTO
{
    /**
     * @template Tr
     *
     * @param class-string<Tr> $className
     * @param ...$args
     * @return Tr
     * @throws \ReflectionException
     */
    public static function transform(string $className, ...$args)
    {
        $newArgs = [];
        $reflection = new \ReflectionClass($className);
        $parameters = array_column($reflection->getMethod('transform')->getParameters(), 'name');

        foreach ($parameters as $parameter) {
            $newArgs[$parameter] = $args[$parameter] ?? null;
        }

        return $className::transform(...$newArgs);
    }
}