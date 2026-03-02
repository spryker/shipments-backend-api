<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\ShipmentsBackendApi\Processor\Reader;

use Generated\Shared\Transfer\SalesShipmentCriteriaTransfer;
use Generated\Shared\Transfer\SalesShipmentResourceCollectionTransfer;
use Spryker\Glue\ShipmentsBackendApi\Dependency\Facade\ShipmentsBackendApiToShipmentFacadeInterface;
use Spryker\Glue\ShipmentsBackendApi\Processor\Mapper\SalesShipmentMapperInterface;

class SalesShipmentResourceReader implements SalesShipmentResourceReaderInterface
{
    /**
     * @var \Spryker\Glue\ShipmentsBackendApi\Processor\Mapper\SalesShipmentMapperInterface
     */
    protected SalesShipmentMapperInterface $salesShipmentMapper;

    /**
     * @var \Spryker\Glue\ShipmentsBackendApi\Dependency\Facade\ShipmentsBackendApiToShipmentFacadeInterface
     */
    protected ShipmentsBackendApiToShipmentFacadeInterface $shipmentFacade;

    public function __construct(SalesShipmentMapperInterface $salesShipmentMapper, ShipmentsBackendApiToShipmentFacadeInterface $shipmentFacade)
    {
        $this->salesShipmentMapper = $salesShipmentMapper;
        $this->shipmentFacade = $shipmentFacade;
    }

    public function getSalesShipmentResourceCollection(SalesShipmentCriteriaTransfer $salesShipmentCriteriaTransfer): SalesShipmentResourceCollectionTransfer
    {
        $salesShipmentCollectionTransfer = $this->shipmentFacade->getSalesShipmentCollection($salesShipmentCriteriaTransfer);

        return $this->salesShipmentMapper->mapSalesShipmentCollectionToSalesShipmentResourceCollection(
            $salesShipmentCollectionTransfer,
            new SalesShipmentResourceCollectionTransfer(),
        );
    }
}
