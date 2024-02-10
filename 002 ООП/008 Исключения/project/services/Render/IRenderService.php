<?php

namespace App\services\Render;

interface IRenderService
{
    public function getRender(string $template, array $params = []): string;
}