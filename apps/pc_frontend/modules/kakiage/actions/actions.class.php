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
    $this->list = Doctrine::getTable('Kakiage')->findByTargetDate(date('Y-m-d'));
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->form = $this->getForm($request);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->form = $this->getForm($request);
    $this->form->bind($request->getParameter($this->form->getName()));

    if ($this->form->isValid())
    {
      $this->form->save();

      $this->redirect('kakiage/index');
    }

    $this->setTemplate('Edit');
  }

  protected function getForm(sfWebRequest $request)
  {
    $kakiage = Doctrine::getTable('Kakiage')
      ->findOneByTargetDateAndMemberId(
          date('Y-m-d'),
          $this->getUser()->getMemberId());

    if (!$kakiage)
    {
      $kakiage = new Kakiage();
      $kakiage->setMemberId($this->getUser()->getMemberId());
    }

    return new KakiageForm($kakiage);
  }
}
