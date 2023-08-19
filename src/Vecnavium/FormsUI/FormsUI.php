<?php

declare(strict_types=1);

namespace Vecnavium\FormsUI;

use pocketmine\plugin\PluginBase;

class FormsUI extends PluginBase {

    /**
     * @param callable|null $function
     * @return CustomForm
     */
    public function createCustomForm(?callable $function = null): CustomForm {
        return new CustomForm($function);
    }

    /**
     * @param callable|null $function
     * @return SimpleForm
     */
    public function createSimpleForm(?callable $function = null): SimpleForm {
        return new SimpleForm($function);
    }

    /**
     * @param callable|null $function
     * @return ModalForm
     */
    public function createModalForm(?callable $function = null): ModalForm {
        return new ModalForm($function);
    }
}

