<?php

namespace Dtc\QueueBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QueueController extends Controller
{
    /**
     * Summary stats.
     *
     * @Route("/")
     * @Route("/status/")
     * @Template()
     */
    public function statusAction()
    {
        $params = array();
        $jobManager = $this->get('dtc_queue.job_manager');

        $params['status'] = $jobManager->getStatus();

        return $params;
    }

    /**
     * List jobs in system by default.
     *
     * @Route("/jobs/")
     */
    public function jobsAction()
    {
        $renderer = $this->get('dtc_grid.renderer.datatables');
        $className = $this->container->getParameter('dtc_queue.job_class');
        $gridSource = $this->get('dtc_grid.manager.source')->get($className);
        $renderer->bind($gridSource);
        $params = $renderer->getParams();

        $renderer2 = $this->get('dtc_grid.renderer.datatables');
        $className = $this->container->getParameter('dtc_queue.job_class_archive');
        $gridSource = $this->get('dtc_grid.manager.source')->get($className);
        $renderer2->bind($gridSource);
        $params2 = $renderer2->getParams();

        $params['archive_grid'] = $params2['dtc_grid'];
        return $this->render('@DtcQueue/Queue/jobs.html.twig', $params);
    }

    /**
     * List jobs in system by default.
     *
     * @Route("/jobs_archive/")
     * @Template()
     */
    public function jobsArchiveAction()
    {
        $renderer = $this->get('grid.renderer.jq_table_grid');

        if (!$this->container->has('dtc_queue.grid.source.job_archive')) {
            throw $this->createNotFoundException();
        }
        $gridSource = $this->get('dtc_queue.grid.source.job_archive');
        $renderer->bind($gridSource);

        return array('grid' => $renderer);
    }

    /**
     * List registered workers in the system.
     *
     * @Route("/workers/")
     * @Template()
     */
    public function workersAction()
    {
        $params = array();

        return $params;
    }

    /**
     * Show a graph of job trends.
     *
     * @Route("/trends/")
     * @Template()
     */
    public function trendsAction()
    {
    }
}
