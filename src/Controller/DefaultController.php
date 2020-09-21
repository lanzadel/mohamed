<?php
namespace App\Controller;
use App\Entity\Account;
use App\Form\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Created by PhpStorm.
 * User: Ch'Mohamed
 * Date: 9/21/2020
 * Time: 9:16 AM
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $account = new Account();
        $form = $this->createForm(AccountType::class, $account);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($account);
            $manager->flush();

            return $this->redirectToRoute("success");
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/list", name="list")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        return $this->render('default/list.html.twig');
    }

    /**
     * @Route("/success", name="success")
     * @return JsonResponse
     */
    public function successAction() {
        return new JsonResponse(['code'=> '200', 'message'=>'Success']);
    }
}