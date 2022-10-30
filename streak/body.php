<?php
/**
 * @var Theme $this
 */
declare(strict_types=1);

use TrayDigita\Streak\Theme\Streak\Theme;

// you can add render view attributes
// $this->renderView->setTitle('Custom Title');

if ($this->is404()) {
    require __DIR__ .'/content/404.php';
    return;
}
if ($this->isErrorResponse()) {
    require __DIR__ .'/content/error.php';
    return;
}

require __DIR__ . '/content/content.php';
