<?php
/**
 * Created by PhpStorm.
 * User: felix.elsener
 * Date: 21.02.2018
 * Time: 09:18
 */

namespace Arcmedia\CategoryRedirect\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(
            SchemaSetupInterface $setup, 
            ModuleContextInterface $context) 
    {
        //No updates in initial file
    }
    
    
}