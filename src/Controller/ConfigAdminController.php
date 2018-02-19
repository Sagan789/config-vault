<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/11/2017
 * Time: 16:19
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Config;
use App\Entity\ConfigItem;
use App\Form\ConfigFormType;

class ConfigAdminController extends Controller
{

	protected $_strNoConfigurationYet = 'There is no Configuration yet';
	protected $_strPageTitleList = 'Config List';
	protected $_strPageTitleAdd = 'Add New Config';


	/**
	 * @Route("/config/list", name="admin_config_list")
	 *
	 * @return mixed
	 */
	public function listAction()
	{
		$repository = $this->getDoctrine()->getRepository(Config::class);
		$configs = $repository->findAll();
		$msg = '';

		return $this->render('config/list.html.twig', array(
				'configs' => $configs,
				'message' => $msg,
				'pageTitle' => $this->_strPageTitleList
		));
	}


	/**
	 * @Route("/config/new", name="admin_config_new")
	 */
	public function newAction(Request $request)
	{
	    $config = new Config();
	    $item = new ConfigItem();
        $item->setConfig($config);
        $item->setItemKey('Key_1');

		$form = $this->createForm(ConfigFormType::class, $config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $config = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($config);
            $em->flush();
            $this->addFlash('success', 'Configuration created!');
            return $this->redirectToRoute('admin_config_list');
        }


		return $this->render('config/new.html.twig', [
				'form' => $form->createView(),
				'pageTitle' => $this->_strPageTitleAdd
		]);
    }

    /**
     * @Route("/config/edit/{id}", name="admin_config_edit" )
     */
    public function editAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Config::class);
        $config = $repository->find($id);

        if (!$config) {
            throw $this->createNotFoundException(
                'No config found for id '.$id
            );
        }
        $form = $this->createForm(ConfigFormType::class, $config);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $config = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($config);
            $em->flush();
            $this->addFlash('success', 'Config updated!');
            return $this->redirectToRoute('admin_config_list');
        }
        return $this->render('config/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/api/config/{id}", name="api_config")
     */
    public function jsonConfigAction($id, Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(Config::class);
        $config = $repository->find($id);
        if (!$config) {
            throw $this->createNotFoundException(
                'No config found for id '.$id
            );
        }

        return $this->json($config->toJson());
    }


    /**
     * @Route("/config/delete/{id}", name="admin_config_delete")
     */
    public function deleteAction($id, Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(Config::class);
        $config = $repository->find($id);
        if (!$config) {
            throw $this->createNotFoundException(
                'No config found for id '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($config);
        $em->flush();
        $this->addFlash('success', 'Config deleted!');
        return $this->redirectToRoute('admin_config_list');
    }

}