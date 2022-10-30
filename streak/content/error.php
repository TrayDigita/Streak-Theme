<?php
/**
 * @var Theme $this
 */
declare(strict_types=1);

use TrayDigita\Streak\Source\Helper\Http\Code;
use TrayDigita\Streak\Theme\Streak\Theme;

?>
    <div class="wrap-position error-content text-center">
        <h1 class="bigger-title"><?= $this->getResponse()->getStatusCode();?></h1>
        <h3 class="description-title"><?= Code::statusMessage($this->getResponse()->getStatusCode());?></h3>
    </div>
<?php
