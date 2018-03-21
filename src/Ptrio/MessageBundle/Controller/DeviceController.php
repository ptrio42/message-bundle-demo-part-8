<?php

namespace App\Ptrio\MessageBundle\Controller;

use App\Ptrio\MessageBundle\Form\Type\DeviceType;
use App\Ptrio\MessageBundle\Model\DeviceInterface;
use App\Ptrio\MessageBundle\Model\DeviceManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeviceController extends FOSRestController
{
    /**
     * @var DeviceManagerInterface
     */
    private $deviceManager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * DeviceController constructor.
     * @param DeviceManagerInterface $deviceManager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        DeviceManagerInterface $deviceManager,
        FormFactoryInterface $formFactory
    )
    {
        $this->deviceManager = $deviceManager;
        $this->formFactory = $formFactory;
    }

    /**
     * @param string $deviceName
     * @return Response
     */
    public function getDeviceAction(string $deviceName): Response
    {
        if ($device = $this->deviceManager->findDeviceByName($deviceName)) {
            $view = $this->view($device, 200);
        } else {
            $view = $this->view(null, 404);
        }
        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function postDeviceAction(Request $request): Response
    {
        /** @var DeviceInterface $device */
        $device = $this->deviceManager->createDevice();

        $form = $this->formFactory->create(DeviceType::class, $device);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $device = $form->getData();
            $this->deviceManager->updateDevice($device);

            $view = $this->view(null, 204);

        } else {
            $view = $this->view($form->getErrors(), 422);
        }

        return $this->handleView($view);
    }

    /**
     * @param string $deviceName
     * @return Response
     */
    public function deleteDeviceAction(string $deviceName): Response
    {
        if ($device = $this->deviceManager->findDeviceByName($deviceName)) {
            $this->deviceManager->removeDevice($device);
            $view = $this->view(null, 204);
        } else {
            $view = $this->view(null, 404);
        }

        return $this->handleView($view);
    }
}