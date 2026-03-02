<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ShipmentsBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;
use Spryker\Glue\ShipmentsBackendApi\Dependency\Facade\ShipmentsBackendApiToShipmentFacadeBridge;

/**
 * @method \Spryker\Glue\ShipmentsBackendApi\ShipmentsBackendApiConfig getConfig()
 */
class ShipmentsBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_SHIPMENT = 'FACADE_SHIPMENT';

    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);
        $container = $this->addShipmentFacade($container);

        return $container;
    }

    protected function addShipmentFacade(Container $container): Container
    {
        $container->set(static::FACADE_SHIPMENT, function (Container $container) {
            return new ShipmentsBackendApiToShipmentFacadeBridge(
                $container->getLocator()->shipment()->facade(),
            );
        });

        return $container;
    }
}
