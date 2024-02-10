<?php

namespace App\services\Render;

class TwigRenderService implements IRenderService
{
    public function getRender(string $template, array $params = []): string
    {
        return  $this->render($template, $params['title'] ?? '', $params);
    }

    protected function render(string $view, string $title, array $params = []): string
    {
        $content = $this->renderView($view, $params);
        return $this->renderView(
            'layout/main',
            [
                'title' => $title,
                'content' => $content
            ]
        );
    }

    protected function renderView(string $view, array $params = []): string
    {
        ob_start();
        extract($params);
        include dirname(__DIR__, 2) . '/views/' . $view . '.php';
        return ob_get_clean();
    }
}