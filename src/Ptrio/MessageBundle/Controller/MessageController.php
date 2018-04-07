<?php

namespace App\Ptrio\MessageBundle\Controller;

use App\Ptrio\MessageBundle\Model\DeviceManagerInterface;
use App\Ptrio\MessageBundle\Model\MessageManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class MessageController extends FOSRestController
{
    /**
     * @var DeviceManagerInterface
     */
    private $deviceManager;

    /**
     * @var MessageManagerInterface
     */
    private $messageManager;

    /**
     * MessageController constructor.
     * @param DeviceManagerInterface $deviceManager
     * @param MessageManagerInterface $messageManager
     */
    public function __construct(
        DeviceManagerInterface $deviceManager,
        MessageManagerInterface $messageManager
    )
    {
        $this->deviceManager = $deviceManager;
        $this->messageManager = $messageManager;
    }

    /**
     * @param string $deviceName
     * @param ParamFetcher $paramFetcher
     * @return Response
     *
     * @QueryParam(name="sort", requirements="(asc|desc)", default="asc")
     * @QueryParam(name="page", requirements="\d+", default="0")
     * @QueryParam(name="results_per_page", requirements="\d+", default="25")
     */
    public function getMessagesAction(string $deviceName, ParamFetcher $paramFetcher): Response
    {
        if ($device = $this->deviceManager->findDeviceByName($deviceName)) {
            $this->denyAccessUnlessGranted(null, $device);
            $sort = $paramFetcher->get('sort');
            $page = $paramFetcher->get('page');
            $resultsPerPage = $paramFetcher->get('results_per_page');
            list($offset, $limit) = [($page * $resultsPerPage), $resultsPerPage];

            $messages = $this->messageManager->findMessagesByDevice($device, $sort, $offset, $limit);

            $view = $this->view($messages, Response::HTTP_OK);
        } else {
            $view = $this->view(null, Response::HTTP_NOT_FOUND);
        }
        return $this->handleView($view);
    }
}