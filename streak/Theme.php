<?php
declare(strict_types=1);

namespace TrayDigita\Streak\Theme\Streak;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use TrayDigita\Streak\Source\Benchmark;
use TrayDigita\Streak\Source\Controller\Abstracts\AbstractController;
use TrayDigita\Streak\Source\Themes\Abstracts\AbstractTheme;
use TrayDigita\Streak\Source\Views\Html\AbstractRenderer;

class Theme extends AbstractTheme
{
    /**
     * @var string
     */
    protected string $name = 'Streak!';

    /**
     * @var string
     */
    protected string $version = '1.0.0';

    /**
     * @var string
     */
    protected string $description = 'Default theme for streak!';

    /**
     * @var string
     */
    protected string $authorName = 'ArrayIterator';

    /**
     * @var string
     */
    protected string $authorURI = 'https://github.com/arrayiterator';

    /**
     * @param string $content
     * @param AbstractRenderer $renderer
     *
     * @return string
     */
    public function appendPerformance(string $content, AbstractRenderer $renderer): string
    {
        $benchmark = $this->getContainer(Benchmark::class);
        $benchmark->addStop('Application:factory');
        $benchmark = $benchmark->get('Application:factory');
        $benchmark = end($benchmark);
        /**
         * example
         * <!-- {
         * "start": 1667128933.155655,
         * "end": 1667128933.264371,
         * "estimated": 0.10871601104736328,
         * "memory": 16777216
         * } -->
         */
        $content .= "<!-- $benchmark -->";
        return $content;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $params
     * @param AbstractController|null $controller
     *
     * @return ResponseInterface
     */
    protected function doRender(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $params = [],
        ?AbstractController $controller = null
    ): ResponseInterface {
        $this->eventAdd('Html:content', [$this, 'appendPerformance']);
        return $this
            ->getRenderView()
            ->render($response);
    }

    /**
     * @param Throwable $exception
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $params
     * @param AbstractController|null $controller
     *
     * @return ResponseInterface
     */
    protected function doRenderException(
        Throwable $exception,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $params = [],
        ?AbstractController $controller = null
    ): ResponseInterface {
        $this->eventAdd('Html:content', [$this, 'appendPerformance']);
        return $this
            ->getRenderView()
            ->render($response);
    }
}
