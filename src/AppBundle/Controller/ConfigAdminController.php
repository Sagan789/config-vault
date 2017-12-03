<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/11/2017
 * Time: 16:19
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Config;
use AppBundle\Entity\ConfigItem;
use AppBundle\Form\ConfigFormType;

class ConfigAdminController extends Controller
{

	protected $_strNoConfigurationYet = 'There is no Configuration yet';
	protected $_strPageTitleList = 'Config List';
	protected $_strPageTitleAdd = 'Add New Config';


	/**
	 * @Route("/config/list")
	 *
	 * @return mixed
	 */
	public function listAction()
	{
		$repository = $this->getDoctrine()->getRepository(Config::class);
		$configs = $repository->findAll();
		$msg = '';

		if (count($configs) === 0) {
			$msg =$this->_strNoConfigurationYet;
		}
		return $this->render('config/list.html.twig', array(
				'configs' => $configs,
				'message' => $msg,
				'pageTitle' => $this->_strPageTitleList
		));
	}


	/**
	 * @Route("/config/new", name="admin_config_new")
	 */
	public function newAction()
	{
		$form = $this->createForm(ConfigFormType::class);
		return $this->render('config/new.html.twig', [
				'configForm' => $form->createView(),
				'pageTitle' => $this->_strPageTitleAdd
		]);
    }


	/**
	 * @Route("/config/add")
	 *
	 * @return mixed
	 */
	public function add(Request $request)
	{
		if ($request->isMethod('POST')) {

			$itemsCount = $request->get('itemsCount');
			$items = [];

			for ($i=1; $i<=$itemsCount; $i++) {
				$items[$request->get('item_key_'.$i)] = $request->get('item_value_'.$i);
			}

			$em = $this->getDoctrine()->getManager();

			$newConfig = new Config();
			$newConfig->setName($request->get('name'));
			$newConfig->setDescription($request->get('description'));
			$newConfig->setDateCreated(new \DateTime('now'));
			$newConfig->setDateModified(new \DateTime('now'));

			foreach ($items as $key => $value) {
				$newItem = new ConfigItem();
				$newItem->setItemKey($key);
				$newItem->setItemValue($value);
				$newItem->setEnvironment(ConfigItem::ENV_DEV);
				$newItem->setType(ConfigItem::TYPE_STRING);
				$newItem->setConfig($newConfig);
				$newConfig->getItems()->add($newItem);
			}


			$em->persist($newConfig);
			$em->flush();

			$repository = $this->getDoctrine()->getRepository(Config::class);
			$configs = $repository->findAll();
			$data = [
						'configs' => $configs,
						'message' =>  'Configuration created !',
			];

			return $this->render('config/list.html.twig', $data);
		}

		return $this->render('config/add.html.twig', array('pageTitle' => $this->_strPageTitleAdd));
	}
}