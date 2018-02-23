<?php
/**
 * Created by PhpStorm.
 * User: felix.elsener
 * Date: 21.02.2018
 * Time: 09:18
 */

namespace Arcmedia\CategoryRedirect\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        //No updates in initial file
    }
}