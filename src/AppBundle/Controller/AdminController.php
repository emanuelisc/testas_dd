<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Order;
use AppBundle\Entity\Car;
use AppBundle\Entity\Driver;
use AppBundle\Form\CarType;
use AppBundle\Form\DriverType;
use AppBundle\Form\SelectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class UserController
 * @package AppBundle\Controller
 *
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_dashboard")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
            ->select('COUNT(u) as user_count')
            ->from('AppBundle:User', 'u')
            ->where('u.role = :role')
            ->setParameter('role', "ROLE_USER")
        ;

        $users = $query->getQuery()->getResult();

        $query = $em->createQueryBuilder()
            ->select('COUNT(o) as order_count')
            ->from('AppBundle:Order', 'o')
        ;

        $orders = $query->getQuery()->getResult();

        $query = $em->createQueryBuilder()
            ->select('COUNT(d) as driver_count')
            ->from('AppBundle:Driver', 'd')
            ->where('d.whenLeaveTerminal is not null')
        ;

        $drivers = $query->getQuery()->getResult();

        $query = $em->createQueryBuilder()
            ->select('COUNT(c) as car_count')
            ->from('AppBundle:Car', 'c')
        ;

        $cars = $query->getQuery()->getResult();

        $query = $em->createQueryBuilder()
            ->select('COUNT(d) as driver_count')
            ->from('AppBundle:Driver', 'd')
            ->where('d.whenLeaveTerminal is null')
        ;
        $orderCount = $query->getQuery()->getResult();

        return $this->render('admin/dashboard.html.twig', [
            'user' => $user,
            'users' => $users,
            'orders' => $orders,
            'drivers' => $drivers,
            'cars' => $cars,
            'orderCount' => $orderCount
        ]);
    }

    /**
     * @Route("/tables", name="tables")
     * @Method({"GET", "POST"})
     */

    public function tablesAction(Request $request)
    {
        $orders = null;
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(SelectType::class, $orders);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orders = $em->createQueryBuilder()
                ->select('o')
                ->from('AppBundle:Order', 'o')
                ->innerJoin('o.user', 'u', 'WITH', 'o.user = u.id')
                ->where('u.username = :username')
                ->andWhere('o.dateToDeliver >= :date')
                ->setParameters(array('username' => $form['user']->getData()->getUsername(), 'date' => $form['dateToDeliver']->getData()))
                ->getQuery()
                ->getResult();
        }else{
            $repository = $this->getDoctrine()->getRepository('AppBundle:Order');
            $orders = $repository->findAll();
        }

        $query = $em->createQueryBuilder()
            ->select('COUNT(d) as driver_count')
            ->from('AppBundle:Driver', 'd')
            ->where('d.whenLeaveTerminal is null');
        $orderCount = $query->getQuery()->getResult();

        return $this->render('admin/information.html.twig', [
            'orders' => $orders,
            'orderCount' => $orderCount,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/users", name="users")
     * @Method("GET")
     */
    public function usersAction(Request $request)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
            ->select('u')
            ->from('AppBundle:User', 'u')
            ->where('u.role = :role')
            ->setParameter('role', "ROLE_USER")
        ;

        $users = $query->getQuery()->getResult();

        $query = $em->createQueryBuilder()
            ->select('COUNT(d) as driver_count')
            ->from('AppBundle:Driver', 'd')
            ->where('d.whenLeaveTerminal is null')
        ;
        $orderCount = $query->getQuery()->getResult();

        return $this->render('admin/users.html.twig', [
            'user' => $user,
            'users' => $users,
            'orderCount' => $orderCount
        ]);
    }

    /**
     * @Route("/drivers", name="drivers")
     * @Method({"GET", "POST"})
     */
    public function driversAction(Request $request)
    {
        $driver = new Driver();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Driver');
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
            ->select('d')
            ->from('AppBundle:Driver', 'd')
            ->where('d.whenCameToCustomer is not null')
        ;
        $drivers = $query->getQuery()->getResult();
        $query = $em->createQueryBuilder()
            ->select('COUNT(d) as driver_count')
            ->from('AppBundle:Driver', 'd')
            ->where('d.whenLeaveTerminal is null')
        ;
        $orderCount = $query->getQuery()->getResult();

        $form = $this->createForm(DriverType::class, $driver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository2 = $this->getDoctrine()->getRepository('AppBundle:Order');
            $repository3 = $this->getDoctrine()->getRepository('AppBundle:Car');
            $order = $repository2->findOneBy(array('id' => $form['order']->getData()));
            $car = $repository3->findOneBy(array('id' => $order->getCar()->getId()));
            $driver = $repository->findOneBy(array('id' => $order->getDriver()->getId()));

            $whenLeaveTerminal = $form['whenLeaveTerminal']->getData();
            $driver->setWhenLeaveTerminal($whenLeaveTerminal);

            $whenCameToCustomer = $form['whenCameToCustomer']->getData();
            $driver->setWhenCameToCustomer($whenCameToCustomer);

            $whenLoadOut = $form['whenLoadOut']->getData();
            $driver->setWhenLoadOut($whenLoadOut);

            $whenLeaveCustomer = $form['whenLeaveCustomer']->getData();
            $driver->setWhenLeaveCustomer($whenLeaveCustomer);

            $whenCameToTerminal = $form['whenCameToTerminal']->getData();
            $driver->setWhenCameToTerminal($whenCameToTerminal);

            $distance = $form['distance']->getData();
            $driver->setDistance($distance);

            $mileageBefore = $order->getCar()->getMillage();
            $driver->setMileageBefore($mileageBefore);

            $mileageNow = $mileageBefore + $form['distance']->getData();
            $driver->setMileageNow($mileageNow);

            $car->setMillage($mileageNow);

            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('drivers');
        }
        return $this->render('admin/driver.html.twig', [
            'drivers' => $drivers,
            'orderCount' => $orderCount,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cars", name="cars")
     * @Method({"GET", "POST"})
     */
    public function carsAction(Request $request)
    {
        $user = $this->getUser();

        $car = new Car();

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder()
            ->select('c')
            ->from('AppBundle:Car', 'c')
        ;
        $cars = $query->getQuery()->getResult();

        $query = $em->createQueryBuilder()
            ->select('COUNT(d) as driver_count')
            ->from('AppBundle:Driver', 'd')
            ->where('d.whenLeaveTerminal is null')
        ;
        $orderCount = $query->getQuery()->getResult();

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brand = $form['brand']->getData();
            $car->setBrand($brand);

            $model = $form['model']->getData();
            $car->setModel($model);

            $millage = $form['millage']->getData();
            $car->setMillage($millage);

            $standing = $form['standing']->getData();
            $car->setStanding($standing);

            $discharging = $form['discharging']->getData();
            $car->setDischarging($discharging);

            $driving = $form['driving']->getData();
            $car->setDriving($driving);

            $height = $form['height']->getData();
            $car->setHeight($height);

            $length = $form['length']->getData();
            $car->setLength($length);

            $width = $form['width']->getData();
            $car->setWidth($width);

            $maxWeight = $form['maxWeight']->getData();
            $car->setMaxWeight($maxWeight);

            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('cars');
        }
        return $this->render('admin/car.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'cars' => $cars,
            'orderCount' => $orderCount
        ]);
    }
}