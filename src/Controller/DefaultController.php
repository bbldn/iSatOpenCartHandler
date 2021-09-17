<?php

namespace App\Controller;

use Throwable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Messenger\OrderFrontHasBeenCreatedMessage;
use Messenger\CustomerFrontHasBeenCreatedMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface as MessageBus;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
class DefaultController extends AbstractController
{
    private MessageBus $messageBus;

    /**
     * @param MessageBus $messageBus
     */
    public function __construct(MessageBus $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function orderAction(Request $request): Response
    {
        $orderId = (int)$request->get('orderId', -1);

        try {
            if (-1 !== $orderId) {
                $this->messageBus->dispatch(new OrderFrontHasBeenCreatedMessage($orderId));
            }
        } catch (Throwable $e) {
            return $this->json(['data' => null, 'errors' => [$e->getMessage()]]);
        }

        return $this->json(['data' => [true]]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function customerAction(Request $request): Response
    {
        $customerId = (int)$request->get('customerId', -1);

        try {
            if (-1 !== $customerId) {
                $this->messageBus->dispatch(new CustomerFrontHasBeenCreatedMessage($customerId));
            }
        } catch (Throwable $e) {
            return $this->json(['data' => null, 'errors' => [$e->getMessage()]]);
        }

        return $this->json(['data' => [true]]);
    }
}