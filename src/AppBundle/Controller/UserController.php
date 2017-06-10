<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Entity\Driver;
use AppBundle\Form\OrderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class UserController
 * @package AppBundle\Controller
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     * @Method({"GET", "POST"})
     */
    public function listAction(Request $request)
    {
        $user = $this->getUser();
        $order = new Order();
        $driver = new Driver();

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        $orders = $user->getOrders();
        $count = 0;
        foreach( $orders as $or){
            $count++;
        }

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $address = $form['address']->getData();
            $order->setAddress($address);

            $date = $form['dateToDeliver']->getData();
            $order->setDateToDeliver($date);

            $car = $form['car']->getData();
            $order->setCar($car);

            $order->setUser($user);
            $order->setDriver($driver);

            $em->persist($order);
            $em->persist($driver);
            $em->flush();
            $this->addFlash(
                'notice',
                'Order created'
            );

            return $this->redirect($this->generateUrl('dashboard'));
        }

        return $this->render('user/dashboard.html.twig', [
            'user' => $user,
            'count' => $count,
            'orders' => $orders,
            'form' => $form->createView(),
        ]);
    }
}