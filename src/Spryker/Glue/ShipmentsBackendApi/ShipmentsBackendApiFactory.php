<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ShipmentsBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractFactory;
use Spryker\Glue\ShipmentsBackendApi\Dependency\Facade\ShipmentsBackendApiToShipmentFacadeInterface;
use Spryker\Glue\ShipmentsBackendApi\Processor\Expander\PickingListsSalesShipmentsResourceRelationshipExpander;
use Spryker\Glue\ShipmentsBackendApi\Processor\Expander\PickingListsSalesShipmentsResourceRelationshipExpanderInterface;
use Spryker\Glue\ShipmentsBackendApi\Processor\Filter\PickingListItemResourceFilter;
use Spryker\Glue\ShipmentsBackendApi\Processor\Filter\PickingListItemResourceFilterInterface;
use Spryker\Glue\ShipmentsBackendApi\Processor\Mapper\SalesShipmentMapper;
use Spryker\Glue\ShipmentsBackendApi\Processor\Mapper\SalesShipmentMapperInterface;
use Spryker\Glue\ShipmentsBackendApi\Processor\Reader\SalesShipmentResourceReader;
use Spryker\Glue\ShipmentsBackendApi\Processor\Reader\SalesShipmentResourceReaderInterface;
use Spryker\Glue\ShipmentsBackendApi\Processor\Reader\SalesShipmentResourceRelationshipReader;
use Spryker\Glue\ShipmentsBackendApi\Processor\Reader\SalesShipmentResourceRelationshipReaderInterface;

class ShipmentsBackendApiFactory extends AbstractFactory
{
    public function createPickingListsSalesShipmentsResourceRelationshipExpander(): PickingListsSalesShipmentsResourceRelationshipExpanderInterface
    {
        return new PickingListsSalesShipmentsResourceRelationshipExpander(
            $this->createPickingListItemResourceFilter(),
            $this->createSalesShipmentResourceRelationshipReader(),
        );
    }

    public function createPickingListItemResourceFilter(): PickingListItemResourceFilterInterface
    {
        return new PickingListItemResourceFilter();
    }

    public function createSalesShipmentResourceRelationshipReader(): SalesShipmentResourceRelationshipReaderInterface
    {
        return new SalesShipmentResourceRelationshipReader($this->createSalesShipmentResourceReader());
    }

    public function createSalesShipmentResourceReader(): SalesShipmentResourceReaderInterface
    {
        return new SalesShipmentResourceReader(
            $this->createSalesShipmentMapper(),
            $this->getShipmentFacade(),
        );
    }

    public function createSalesShipmentMapper(): SalesShipmentMapperInterface
    {
        return new SalesShipmentMapper();
    }

    public function getShipmentFacade(): ShipmentsBackendApiToShipmentFacadeInterface
    {
        return $this->getProvidedDependency(ShipmentsBackendApiDependencyProvider::FACADE_SHIPMENT);
    }
}
