<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * kakiage actions.
 *
 * @package    OpenPNE
 * @subpackage kakiage
 * @author     Rimpei Ogawa <ogawa@tejimaya.com>
 */
class kakiageActions extends sfActions
{
  public function initialize($context, $moduleName, $actionName)
  {
    parent::initialize($context, $moduleName, $actionName);

    $this->security['all'] = array('is_secure' => true, 'credentials' => 'SNSMember');
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->date = $this->checkDateForRequest($request);
    $this->list = Doctrine::getTable('Kakiage')->findByTargetDate($this->date);
  }

  public function executeWeek(sfWebRequest $request)
  {
    $this->list = Doctrine::getTable('Kakiage')->getWeekly($this->getUser()->getMemberId());
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->date = $this->checkDateForRequest($request);
    $this->form = $this->getForm($request, $this->date);

    $this->previous = Doctrine::getTable('Kakiage')->getPrevious($this->getUser()->getMemberId(), $this->date);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->date = $this->checkDateForRequest($request);
    $this->form = $this->getForm($request, $this->date);

    $this->form->bind($request->getParameter($this->form->getName()));
    if ($this->form->isValid())
    {
      $this->form->save();

      $this->redirect('@kakiage_date?'.strftime('year=%Y&month=%m&day=%d', strtotime($this->date)));
    }

    $this->setTemplate('edit');
  }

  protected function getForm(sfWebRequest $request, $date)
  {
    $kakiage = Doctrine::getTable('Kakiage')
      ->findOneByTargetDateAndMemberId(
          $date,
          $this->getUser()->getMemberId());

    if (!$kakiage)
    {
      $kakiage = new Kakiage();
      $kakiage->setMemberId($this->getUser()->getMemberId());
      $kakiage->setTargetDate($date);
    }

    return new KakiageForm($kakiage);
  }

  protected function checkDateForRequest(sfWebRequest $request)
  {
    $year  = (int)$request['year'];
    $month = (int)$request['month'];
    $day   = (int)$request['day'];

    if ($year && $month && $day)
    {
      $this->forward404Unless(checkdate($month, $day, $year), 'Invalid date format');

      $date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
    }
    else
    {
      $date = date('Y-m-d');
    }

    return $date;
  }
}
